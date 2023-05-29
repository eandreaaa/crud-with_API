<?php

namespace App\Http\Libraries; //mengatur posisi file

use Illuminate\Support\Facades\Http;
use Nette\Utils\Arrays;

class BaseApi 
{
    // variable yg cmn bisa d akses d class dan turunannya
    protected $baseUrl;

    // constractor : menyiapkan isi data, dijalankan otomatis tanpa dipanggil
    public function __construct()
    {
        // variable $baseUrl diatas diisi nilainya dr isian .env bag. API_HOST
        // var diisi otomatis ketika file/class BaseApi dpanggil di controller
        $this->baseUrl = "http://127.0.0.1:9669";
    }

    private function client()
    {
        // koneksikan ip dr var $baseUrl ke dependency Http
        // menggunkan depedency Http krn projek API berbasis web (protocol Http)
        // depedency-> sama spt package, tp versi lbh sedikit
        return Http::baseUrl($this->baseUrl);
    }

    public function index(String $endpoint, Array $data = [])
    {
        // manggil ke func client yg d atas, trs manggil path yg dari $endpoint yg dikirim 
        // controllernya, kalau ada data yg mau dicari (params di postman) diambil dr paramater2 $data
        return $this->client()->get($endpoint, $data);
    }

    public function store(String $endpoint, Array $data = [])
    {
        return $this->client()->post($endpoint, $data);
    }

    public function edit(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }

    public function update(String $endpoint, Array $data = [])
    {
        return $this->client()->patch($endpoint, $data);
    }

    public function delete(String $endpoint, Array $data = [])
    {
        return $this->client()->delete($endpoint, $data);
    }

    public function trash(String $endpoint)
    {
        return $this->client()->get($endpoint);
    }

    public function permanent(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }

    public function restore(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }

    //helpers sama kyak service, method cuma 1->membuat API
    //libraries method ada lebih dari 1->ambil data dari API
}