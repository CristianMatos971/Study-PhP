<?php

namespace App\Controllers;

use App\controllers\ErrorController;
use Framework\Database;
use Framework\Validation;


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
        $listings = $this->db->query('SELECT * FROM listings')->fetchAll();
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
     * @param array params
     * @return void
     */
    public function show($params)
    {
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', ['listing' => $listing]);
    }


    /**
     * Criar um job listing no banco de dados
     *
     * @return void
     */
    public function store()
    {
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
        //inspectAndDie($newListingData);
        $newListingData['user_id'] = 1;
        $newListingData = array_map('sanitize', $newListingData);

        $requiredFields = ['title', 'description', 'city', 'state', 'email'];

        $errors = [];


        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            //recarregar a página com erros
            loadView('listings/create', ['errors' => $errors, 'listing' => $newListingData]);
        } else {
            //enviar os dados para slvar no banco.
            $fields = [];

            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);

            $values = [];

            foreach ($newListingData as $field => $value) {
                if ($value === '') {
                    $newListingData[$field] = NULL;
                }
                $values[] = ':' . $field;
            }

            $values = implode(', ', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";
            //inspectAndDie($query);
            $this->db->query($query, $newListingData);

            redirect('\listings');
        }
    }

    /**
     * Deletar um job listing do banco de dados
     * 
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];

        $params = ['id' => $id];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params);

        if (!$listing) {
            ErrorController::notFound();
            return;
        } else {
            $this->db->query('DELETE FROM listings WHERE id = :id', $params);
            redirect('/listings');
        }
    }
}
