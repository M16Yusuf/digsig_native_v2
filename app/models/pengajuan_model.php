<?php

class pengajuan_model
{

    private $table = 'lembar_tb';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // ambil semua data pengajuan
    public function getAllPengajuan()
    {
        $query = "SELECT lembar_tb.id_lembar, lembar_tb.subjek, lembar_tb.path, lembar_tb.created_at, dosen_tb.nama, dosen_tb.nip, lembar_tb.ttd_kaprodi, lembar_tb.ttd_dekan, lembar_tb.ttd_divisi
        FROM lembar_tb INNER JOIN dosen_tb ON dosen_tb.id_dosen = lembar_tb.dosen_id ORDER BY lembar_tb.created_at DESC";
        //execute terjadi pada class database
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // amil semua data pengajuan
    public function getPengajuanById($id)
    {
        $query = 'SELECT * FROM lembar_tb INNER JOIN dosen_tb ON dosen_tb.id_dosen = lembar_tb.dosen_id WHERE id_lembar =:id';
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // ambil semua data pengajuan berdasarkan orang yg login $_SESSION['nip']
    public function getAllPengajuanBySession($nip)
    {
        $query = "SELECT lembar_tb.id_lembar, lembar_tb.subjek, lembar_tb.path, lembar_tb.created_at, dosen_tb.nama, dosen_tb.nip, lembar_tb.ttd_kaprodi, lembar_tb.ttd_dekan, lembar_tb.ttd_divisi
        FROM lembar_tb INNER JOIN dosen_tb ON dosen_tb.id_dosen = lembar_tb.dosen_id WHERE dosen_tb.nip =:nip ORDER BY lembar_tb.created_at DESC";
        //execute terjadi pada class database
        $this->db->query($query);
        $this->db->bind('nip', $nip);
        return $this->db->resultSet();
    }


    public function tambahDataPengajuan($data)
    {
        $query = "INSERT INTO " . $this->table . " VALUES ('', :subjek, :path, :created_at, :ttd_kaprodi, :ttd_dekan, :ttd_divisi, :dosen_id)";
        // bind query menghindari bahaya SQLinjektor
        $this->db->query($query);
        $this->db->bind('subjek', $data['subjek']);
        $this->db->bind('path', $data['path']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('ttd_kaprodi', $data['ttd_kaprodi']);
        $this->db->bind('ttd_dekan', $data['ttd_dekan']);
        $this->db->bind('ttd_divisi', $data['ttd_divisi']);
        $this->db->bind('dosen_id', $data['dosen_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function hapusDataPengajuan($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_lembar=:id";
        //bind query menghindari bahaya SQLinjecktor
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        //cari db yang terpengaruh atau tidak
        return $this->db->rowCount();
    }


    public function cariDataPengajuan($subjek)
    {
        $query = "SELECT lembar_tb.id_lembar, lembar_tb.subjek, lembar_tb.path, lembar_tb.created_at, dosen_tb.nama, dosen_tb.nip, lembar_tb.ttd_kaprodi, lembar_tb.ttd_dekan, lembar_tb.ttd_divisi 
        FROM lembar_tb INNER JOIN dosen_tb ON dosen_tb.id_dosen = lembar_tb.dosen_id WHERE lembar_tb.subjek LIKE :subjek ORDER BY lembar_tb.created_at DESC";
        $this->db->query($query);
        $this->db->bind('subjek', "%$subjek%");
        $this->db->execute();
        return $this->db->resultSet();
    }
}
