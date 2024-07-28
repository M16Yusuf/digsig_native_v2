<?php
class Pengajuan extends Controller
{

    public function __construct()
    {
        Auth::check();
    }

    // data dashboard pengajuan
    public function index()
    {
        $data['title'] = 'Dashboard pengajuan';
        $data['data_pengajuan'] = $this->model('pengajuan_model')->getAllPengajuanBySession($_SESSION['nip']);
        // view
        $this->view('templates/header', $data);
        $this->view('pengajuan/index', $data);
        $this->view('templates/footer');
    }

    // get data halaman pengajuan/detal
    public function detail($id)
    {
        $data['title'] = 'Detail pengajuan';
        // ambil data pengajuan dari id
        $data['data_pengajuan'] = $this->model('pengajuan_model')->getPengajuanById($id);
        // ambil semua data tandatangan
        $data['ttd_pengajuan'] = $this->model('tandatangan_model')->getTandatanganbyLembar($id);
        // view halaman & data 
        $this->view('templates/header', $data);
        $this->view('pengajuan/detail', $data);
        $this->view('templates/footer');
    }

    // olah data POST sebelum masuk $data dan dikirim ke query di model
    public function tambah()
    {
        $data = $_POST;
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('y-m-d H:i:s');

        //ambil informasi file
        $name      = $_FILES['file_input']['name'];
        $ukuran    = $_FILES['file_input']['size'];
        $ext_boleh = array('pdf');
        $x         = explode('.', $name);
        $ext       = strtolower(end($x));
        $dir       = "/xampp/htdocs/digsig_native_v2/public/uploads/lembar/";
        $finalname = date('h-i-s-j-m-y') . '_' . str_replace(' ', '_', $name);

        // pengecekan extensi
        if (!in_array($ext, $ext_boleh)) {
            Flasher::setFlash('lembar pengajuan ', ' bukan format yang dianjurkan', 'danger');
            header('location: ' . BASEURL . '/pengajuan');
            exit;
        } else {
            if ($ukuran < 1044070) {
                // pindahkan file 
                if (move_uploaded_file($_FILES['file_input']['tmp_name'], $dir . $finalname)) {
                    // jika file berhasih dipindahkan masukan data
                    $data['path'] = $finalname;
                    $data['created_at']  = $currentDate;
                    $data['ttd_kaprodi']  = false;
                    $data['ttd_dekan']  = false;
                    $data['ttd_divisi']  = false;
                    $data['dosen_id'] = $_SESSION['id_dosen']; 

                    if ($this->model('pengajuan_model')->tambahDataPengajuan($data) > 0) {
                        Flasher::setFlash('lembar pengajuan ', ' berhasil ditambahkan', 'success');
                        header('Location:' . BASEURL . '/pengajuan');
                        exit;
                    }
                } else {
                    $info_error = $_FILES['file_input']['error'];
                    Flasher::setFlash('lembar pengajuan ', ' gagal dalam pengiriman file ' . $info_error, 'danger');
                    header('location: ' . BASEURL . '/pengajuan');
                    exit;
                }
            } else {
                Flasher::setFlash('lembar pengajuan ', ' tidak sesuai dengan ukuran yang dianjurkan', 'danger');
                header('Location:' . BASEURL . '/pengajuan');
                exit;
            }
        }
    }

    // hapus data
    public function hapus($id)
    {
        if ($this->model('pengajuan_model')->hapusDataPengajuan($id) > 0) {
            Flasher::setFlash('lembar pengajuan ', ' berhasil dihapus', 'success');
            header('Location:' . BASEURL . '/pengajuan');
            exit;
        } else {
            Flasher::setFlash('lembar pengajuan ', ' gagal dihapus', 'warning');
            header('Location:' . BASEURL . '/pengajuan');
            exit;
        }
    }

    // cari data
    public function cari()
    {
        $subjek = $_POST['key_subjek'];
        $data['title'] = 'Dashboard pengajuan';
        $data['data_pengajuan'] = $this->model('pengajuan_model')->cariDataPengajuan($subjek);
        // tampilkan view dengan data 
        $this->view('templates/header', $data);
        $this->view('pengajuan/index', $data);
        $this->view('templates/footer');
        
    }
}
