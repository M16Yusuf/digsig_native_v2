<?php 


class Verifikasi extends Controller {
    
    public function index($token)
    {
        $data['title'] = 'Verifikasi tandatangan';
        
        $check = $this->model('tandatangan_model')->verifikasi($token);
        if($check== 0){
            Flasher::setFlash('Data tandatangan tidak ditemukan pada ', ' sistem Digital Signature P2M UNIKOM' , 'danger');
            $this->view('verifikasi/invalid', $data);
        }else {
            // jika data ada
            Flasher::setFlash('Data tandatangan dinyatakan benar dan ada pada ', 'sistem Digital Signature P2M UNIKOM' , 'success');
            $data['data_verifikasi'] = $check;
            $this->view('verifikasi/index', $data); 
            exit;
        }
    }
}


?>