<?php

class App
{
    protected $controller = 'login';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();                                     // dapatkan array url dari function parseURL
        // var_dump($url);

        // controller
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {  // pengecekan controller berdasar input url dari browser
            $this->controller = $url[0];                              // masukan nilai array pertama pada variable
            unset($url[0]);                                           // hilangkan nilai array pertama 
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;                    // instance / instansiasi 

        // method 
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {         // pengecekan method ada tidak pada controllernya
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if(!empty($url)){
            $this->params = array_values($url); 
        }

        //jalankan controller & method dan kirim params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');                  // hilangkan "/" pda url inputan dari browser
            $url = filter_var($url, FILTER_SANITIZE_URL);     // filter url 
            $url = explode('/', $url);                        // ubah url jadi array dengan "/" sebagai pemisah
            return $url;
        }
        return [];
    }
}
