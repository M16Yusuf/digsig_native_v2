<?php

class tandatangan_model
{
    private $table = 'tandatangan_tb';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // tambah tandatangan 
    public function tambahTandatangan($data)
    {
        $query = "INSERT INTO " . $this->table . " VALUES('', :path, :privatekey, :publickey, :signature, :token, :signed_at, :lembar_id, :dosen_id )";
        // bind query menghindari bahaya SQLinjektor
        $this->db->query($query);
        $this->db->bind('path', $data['path']);
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
