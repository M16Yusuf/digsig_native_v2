<?php

class tandatangan_model
{
    private $table = 'tandatangan_tb';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // amil semua data pengajuan
    public function getTandatanganById($id)
    {
        /*yg ini masih error kalo inner join 3 table 
        SELECT tandatangan_tb.id_tanda, tandatangan_tb.path_s, tandatangan_tb.signature, tandatangan_tb.token, tandatangan_tb.signed_at,
         dosen_tb.nip, dosen_tb.nama, dosen_tb.jabatan,  
        lembar_tb.id_lembar, lembar_tb.subjek, lembar_tb.path, lembar_tb.created_at, lembar_tb.ttd_kaprodi, lembar_tb.ttd_dekan, lembar_tb.ttd_divisi 
        FROM tandatangan_tb INNER JOIN dosen_tb ON tandatangan_tb.dosen_id = dosen_tb.id_dosen
        INNER JOIN lembar_tb ON tandatangan_tb.lembar_id = lembar_tb.id_lembar WHERE id_lembar =:id*/
        
        // SELECT * FROM lembar_tb WHERE id_lembar =:id

        //SELECT * FROM `dosen_tb` a inner join lembar_tb b inner join tandatangan_tb c on a.id_dosen = b.dosen_id AND b.id_lembar = c.lembar_id where c.lembar_id = '185' order by c.signed_at desc limit 1;
        
        $query = 'SELECT * FROM lembar_tb INNER JOIN dosen_tb ON dosen_tb.id_dosen = lembar_tb.dosen_id WHERE id_lembar =:id';
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // ambil semua tandatangan pada lembar 
    public function getTandatanganbyLembar($id)
    {
        $query = 'SELECT tandatangan_tb.id_tanda, tandatangan_tb.signature, tandatangan_tb.token, 
        tandatangan_tb.signed_at, dosen_tb.nip, dosen_tb.nama, dosen_tb.jabatan, lembar_tb.subjek, lembar_tb.path 
        FROM tandatangan_tb INNER JOIN dosen_tb ON tandatangan_tb.dosen_id = dosen_tb.id_dosen
        INNER JOIN lembar_tb ON tandatangan_tb.lembar_id = lembar_tb.id_lembar  WHERE lembar_tb.id_lembar =:id
        ORDER BY tandatangan_tb.signed_at ASC';
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    // tambah tandatangan 
    public function tambahTandatangan($data)
    {
        $query = "INSERT INTO " . $this->table . " VALUES('', :path_s, :privatekey, :publickey, :signature, :token, :signed_at, :lembar_id, :dosen_id )";
        // bind query menghindari bahaya SQLinjektor
        $this->db->query($query);
        $this->db->bind('path_s', $data['path_s']);
        $this->db->bind('privatekey', $data['privatekey']);
        $this->db->bind('publickey', $data['publickey']);
        $this->db->bind('signature', $data['signature']);
        $this->db->bind('token', $data['token']);
        $this->db->bind('signed_at', $data['signed_at']);
        $this->db->bind('lembar_id', $data['lembar_id']);
        $this->db->bind('dosen_id', $data['dosen_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function verifikasi($token)
    {
        $query = 'SELECT tandatangan_tb.id_tanda, tandatangan_tb.signature, tandatangan_tb.token, 
        tandatangan_tb.signed_at, dosen_tb.nip, dosen_tb.nama, lembar_tb.subjek, lembar_tb.path 
        FROM tandatangan_tb INNER JOIN dosen_tb ON tandatangan_tb.dosen_id = dosen_tb.id_dosen
        INNER JOIN lembar_tb ON tandatangan_tb.lembar_id = lembar_tb.id_lembar WHERE token =:token';
        $this->db->query($query);
        $this->db->bind('token', $token);
        return $this->db->single();
    }
}
