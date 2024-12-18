<?php

class login extends Controller
{

    public function index()
    {
        $data['title'] = 'Dashboard pengajuan';
        $this->view('login/index', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_POST['nip'];
            $password = $_POST['password'];
        }

        $user = $this->model('dosen_model')->getDosenByNip($nip);
        if ($user && password_verify($password, $user['pwd'])) {
            $_SESSION['nip'] = $user['nip'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['id_dosen'] = $user['id_dosen'];
            $_SESSION['jabatan']  = $user['jabatan'];

            // tampilkan halaman pengajaun beserta datanya
            // $data['title'] = 'Dashboard pengajuan';
            // $data['data_pengajuan'] = $this->model('pengajuan_model')->getAllPengajuanBySession();
            Flasher::setFlash('Selamat datang ', $user['nama'], 'secondary');
            header('Location: ' . BASEURL . '/pengajuan');
            
            exit;
        } else {
            Flasher::setFlash('NIP atau password ', ' salah ', 'danger');
            $this->view('login/index');
            exit;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->view('login/index');
    }
}
