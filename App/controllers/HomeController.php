<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Carregar a página principal e os dados do banco
     *
     * @return void
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings Limit 6')->fetchAll();
        loadView('home', $listings);
    }
}
