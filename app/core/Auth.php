<?php

class Auth {
    public static function check() {
        // jika tidak ada session maka mulai session baru
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // jika data pada session kosong maka kembalikan ke halaman login
        if (!isset($_SESSION['nip'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }
}