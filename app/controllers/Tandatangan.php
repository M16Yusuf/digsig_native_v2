<?php

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;
use EllipticCurve\PrivateKey;
use setasign\Fpdi\Fpdi;


class Tandatangan extends Controller
{

    public function index()
    {
        $data['title'] = 'dashbaord tandatangan';
        $data['data_pengajuan'] = $this->model('pengajuan_model')->getAllPengajuan();
        // view 
        $this->view('templates/header', $data);
        $this->view('tandatangan/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail pengajuan';
        $data['data_pengajuan'] = $this->model('pengajuan_model')->getPengajuanById($id);

        $this->view('templates/header', $data);
        $this->view('tandatangan/detail', $data);
        $this->view('templates/footer');
    }

    public function tandatangan($id)
    {
        // get data by id  
        $data_p['data_pengajuan'] = $this->model('pengajuan_model')->getPengajuanById($id);
        $filename = '/xampp/htdocs/digsig_native_v2/public/uploads/lembar/' . $data_p['data_pengajuan']['path']; // file dari path 
        $message = file_get_contents($filename);

        //generate key 
        $privateKey = new EllipticCurve\PrivateKey;
        $publicKey = $privateKey->publicKey();

        //tandatangan atau sign
        $signature = EllipticCurve\Ecdsa::sign($message, $privateKey);
        $sig_b64 = $signature->toBase64();
        $re_b68 = \EllipticCurve\Signature::fromBase64($sig_b64);

        // QRcode render option ("chillerlan/php-qrcode" version ="^5.0")
        //membuat qrco
        $myoptions = new QROptions;
        $myoptions->version          = 7;
        $myoptions->outputType       = QROutputInterface::GDIMAGE_PNG;
        $myoptions->quality          = 90;
        $myoptions->scale            = 20;
        $myoptions->bgColor          = [200, 150, 200];
        $myoptions->imageTransparent    = true;
        $myoptions->transparencyColor   = [200, 150, 200];
        $myoptions->keepAsSquare     = [
            QRMatrix::M_FINDER_DARK,
            QRMatrix::M_FINDER_DOT,
            QRMatrix::M_ALIGNMENT_DARK,
        ];
        $myoptions->outputBase64     = false;
        // ecc level H is required for logo space
        $optionslogo = new QROptions([
            'version'             => 5,
            'eccLevel'            => EccLevel::H,
            'imageBase64'         => false,
            'addLogoSpace'        => true,
            'logoSpaceWidth'      => 13,
            'logoSpaceHeight'     => 13,
            'scale'               => 6,
            'imageTransparent'    => false,
            'keepAsSquare'        => [QRMatrix::M_FINDER, QRMatrix::M_FINDER_DOT],
        ]);

        //render qrcode  
        $qrcode = new QRCode($myoptions);
        $token  = str_replace(array( '\'','"',',',';','<','>','/','+','=','&','!','#','@','$','%' ),'',$sig_b64);
        $qrcode->addByteSegment('http://localhost/digsig_native_v2/public/verifikasi/'.$token);
        // header('Content-type: image/png');
        $qrdenganlogo = new QRImageWithLogo($optionslogo, $qrcode->getMatrix());
        $tmp_qrlogo  = "/xampp/htdocs/digsig_native_v2/public/tmp/temp_qrcodelogo.png";
        $logo_unikom = "/xampp/htdocs/digsig_native_v2/public/img/logo_unikom.png";
        $gambarQR = $qrdenganlogo->dump($tmp_qrlogo, $logo_unikom);
        file_put_contents($tmp_qrlogo, $gambarQR);

      
        // render gambar qrcode kedalam pdf
        $pdf = new FPDI();
        $file_path = "/xampp/htdocs/digsig_native_v2/public/uploads/lembar/".$data_p['data_pengajuan']['path']; 
        var_dump($file_path);
        $lembar = $pdf->setSourceFile($filename);
        for ($pageNo = 1; $pageNo <= $lembar; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplId, 0, 0);

            // Menambahkan QR code ke halaman PDF
            // Atur posisi dan ukuran sesuai kebutuhan (x,y,w,h)
            $pdf->Image($tmp_qrlogo, 27, 130, 35, 35);
        }
        $signed_dir = '/xampp/htdocs/digsig_native_v2/public/uploads/signed/signed_'.$data_p['data_pengajuan']['path'];
        $pdf->Output('F', $signed_dir );
        
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('y-m-d H:i:s');

        //inputan ke database
        $data['path'] = 'signed_'.$data_p['data_pengajuan']['path'];
        $data['privatekey'] = $privateKey->toPem();
        $data['publickey'] = $publicKey->toPem();
        $data['signature'] = $sig_b64;
        $data['token'] = $token;
        $data['signed_at'] = $currentDate;
        $data['lembar_id'] = $id;
        $data['dosen_id']  = $_SESSION['id_dosen'];
        
        if ($this->model('tandatangan_model')->tambahTandatangan($data) > 0) {
            Flasher::setFlash('lembar pengajuan ', ' berhasil ditandatangan', 'success');
            header('Location:' . BASEURL . '/tandatangan/detail/'.$id);
            exit;
        }
    }
}
