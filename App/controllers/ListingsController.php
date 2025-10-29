<?php

namespace App\Controllers;

use App\controllers\ErrorController;
use Framework\Database;
use Framework\Validation;
use Framework\Authorization;
use Framework\Session;

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
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();
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
        $newListingData['user_id'] = Session::get('user')['id'];
        $newListingData = array_map('sanitize', $newListingData);

        $requiredFields = ['title', 'description', 'city', 'state', 'email'];

        $errors = [];


        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
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

            redirect('/listings');
        }
    }

    /**
     * Deletar um job listing do banco de dados
     * 
     * @return void
     */
    public function destroy($params)
    {
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound();
            return;
        }

        if (!Authorization::isOwner($listing->id)) {
            Session::setFlashMessage('error_message', "You are not authorized to delete this listing");
            return redirect('/listings/' . $listing->id);
        } else {
            $this->db->query('DELETE FROM listings WHERE id = :id', $params);
        }

        Session::setFlashMessage('success_message', "Listing [{$listing->title}] deleted successfully");
        redirect('/listings');
    }

    /**
     * Carregar a view para editar listings
     * 
     * @param array $params
     * @return void
     */
    public function edit($params)
    {
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        if (!Authorization::isOwner($listing->id)) {
            Session::setFlashMessage('error_message', 'You are not authorized to edit this listing');
            return redirect('/listings/' . $listing->id);
        }

        loadView('listings/edit', ['listing' => $listing]);
    }

    public function update($params)
    {
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        if (!Authorization::isOwner($listing->id)) {
            Session::setFlashMessage('error_message', 'You are not authorized to edit this listing');
            return redirect('/listings/' . $listing->id);
        }

        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];
        $updateValues = [];
        $updateValues = array_intersect_key($_POST, array_flip($allowedFields));
        $updateValues = array_map('sanitize', $updateValues);

        $requiredFields = ['title', 'description', 'city', 'state', 'email'];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {

                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {

            loadView('listings/edit', ['listing' => $listing, 'errors' => $errors]);
            exit;
        } else {
            //Mandar o update pro banco de dados
            $keys = array_keys($updateValues);
            $values_str = "";
            foreach ($keys as $key) {
                $values_str .= $key . ' = :' . $key . ', ';
            }
            $values_str = substr($values_str, 0, -2);

            $updateValues['id'] = $params['id'];

            $query = 'UPDATE listings SET ' . $values_str . ' WHERE id = :id';

            $this->db->query($query, $updateValues);
            Session::setFlashMessage('success_message', 'Listing updated successfully');

            redirect('/listings/' . $params['id']);
        }
    }
}
