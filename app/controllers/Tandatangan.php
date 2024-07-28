<?php

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;
use EllipticCurve\PrivateKey;
use setasign\Fpdi\Fpdi;


class Tandatangan extends Controller
{

    public function __construct()
    {
        Auth::check();
    }

    //tampil pengajuan berdasarkan penandatangan
    public function index()
    {
        $data['title'] = 'dashbaord tandatangan';
        $data['data_pengajuan'] = $this->model('pengajuan_model')->getAllPengajuan();

        $this->view('templates/header', $data);
        $this->view('tandatangan/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail tandatangan';
        // ambil data pengajuan by id  
        $data['data_pengajuan'] = $this->model('tandatangan_model')->getTandatanganById($id);
        // ambil semua data tandatangan
        $data['ttd_pengajuan'] = $this->model('tandatangan_model')->getTandatanganbyLembar($id);
        // view halaman & data 
        $this->view('templates/header', $data);
        $this->view('tandatangan/detail', $data);
        $this->view('templates/footer');
    }

    public function tandatangan($id)
    {
        // get data by id  
        $data_p['data_pengajuan'] = $this->model('pengajuan_model')->getPengajuanById($id);
        $file_path = '/xampp/htdocs/digsig_native_v2/public/uploads/lembar/' . $data_p['data_pengajuan']['path'];
        $message = file_get_contents($file_path);


        //generate key 
        $privateKey = new EllipticCurve\PrivateKey;
        $publicKey = $privateKey->publicKey();
        //tandatangan atau sign
        $signature = EllipticCurve\Ecdsa::sign($message, $privateKey);
        $sig_b64 = $signature->toBase64();


        // QRcode render option ("chillerlan/php-qrcode" version ="^5.0")
        $myoptions = new QROptions;
        $myoptions->version          = 7;
        $myoptions->outputType       = QROutputInterface::GDIMAGE_PNG;
        $myoptions->outputBase64     = false;
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
        // logo render optionn 
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
        $token  = str_replace(array('\'', '"', ',', ';', '<', '>', '/', '+', '=', '&', '!', '#', '@', '$', '%'), '', $sig_b64);
        $qrcode->addByteSegment('http://localhost/digsig_native_v2/public/verifikasi/' . $token);
        // header('Content-type: image/png');
        $qrdenganlogo = new QRImageWithLogo($optionslogo, $qrcode->getMatrix());
        $tmp_qrlogo  = "/xampp/htdocs/digsig_native_v2/public/tmp/temp_qrcodelogo.png";
        $logo_unikom = "/xampp/htdocs/digsig_native_v2/public/img/logo_unikom.png";
        $gambarQR = $qrdenganlogo->dump($tmp_qrlogo, $logo_unikom);
        file_put_contents($tmp_qrlogo, $gambarQR);


        // render gambar qrcode kedalam pdf dan hapus gambar dari temp
        $pdf = new FPDI();
        $lembar = $pdf->setSourceFile($file_path);
        if ($_SESSION['jabatan'] == 'kaprodi') {
            $x = 27;  // posisi horizontal
            $y = 130; // posisi vertikal
            $w = 35;  // lebar qr pada pdf
            $h = 35;  // tinggi qr pada pdf
        }elseif($_SESSION['jabatan'] == 'dekan'){
            $x = 120;
            $y = 130;
            $w = 35;
            $h = 35;
        }else{
            $x = 100;
            $y = 178;
            $w = 35;
            $h = 35;
        }
        for ($pageNo = 1; $pageNo <= $lembar; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplId, 0, 0);
            // Menambahkan QR code ke halaman PDF
            // Atur posisi dan ukuran sesuai kebutuhan (x,y,w,h)
            $pdf->Image($tmp_qrlogo, $x, $y, $w, $h);
        }
        $pdf->Output('F', $file_path);
        unlink($tmp_qrlogo);


        //array untuk ke database
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('y-m-d H:i:s');
        $data['path_s'] = 'signed_' . $data_p['data_pengajuan']['path'];
        $data['privatekey'] = $privateKey->toPem();
        $data['publickey'] = $publicKey->toPem();
        $data['signature'] = $sig_b64;
        $data['token'] = $token;
        $data['signed_at'] = $currentDate;
        $data['lembar_id'] = $id;
        $data['dosen_id']  = $_SESSION['id_dosen'];
        //update status tandatangan
        $this->model('pengajuan_model')->updateStatusTTD($_SESSION['jabatan'], $id);
        //input data ke database
        if ($this->model('tandatangan_model')->tambahTandatangan($data) > 0) {
            Flasher::setFlash('lembar pengajuan ', ' berhasil ditandatangan', 'success');
            header('Location:' . BASEURL . '/tandatangan/detail/' . $id);
            exit;
        }
    }

    // cari data berdasarkan subjek
    public function cari()
    {
        $subjek = $_POST['key_subjek'];
        $data['title'] = 'Dashboard pengajuan';
        $data['data_pengajuan'] = $this->model('pengajuan_model')->cariDataPengajuan($subjek);
        // tampilkan view dengan data 
        $this->view('templates/header', $data);
        $this->view('tandatangan/index', $data);
        $this->view('templates/footer');
    }
}
