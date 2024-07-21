<?php

class dosen_model
{
    private $table = 'dosen_tb';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDosenByNip($nip)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE nip =:nip';
        $this->db->query($query);
        $this->db->bind('nip', $nip);
        return $this->db->single();
    }
}
