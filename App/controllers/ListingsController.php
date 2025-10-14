<?php

namespace App\Controllers;

use Framework\Database;

class ListingsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Carregar os dados do banco - job listings
     *
     * @return void
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings Limit 6')->fetchAll();
        loadView('listings/index', $listings);
    }


    /**
     * Carregar a página para criar posts
     *
     * @return void
     */
    public function create()
    {
        loadView('listings/create');
    }

    /**
     * Carregar a página com detalhes individuais de cada post/job listing
     *
     * @return void
     */
    public function show()
    {
        $id = $_GET['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
        loadView('listings/show', ['listing' => $listing]);
    }
}
