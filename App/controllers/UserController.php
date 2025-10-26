<?php

namespace App\controllers;

use Framework\Database;
use Framework\Validation;


class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Mostrar a página de registrar usuário
     *
     * @return void
     */
    public function create()
    {
        loadView('users/create');
    }

    /**
     * Mostrar a página de login
     *
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }

    /**
     * Registrar efetivamente um usuário no banco de dados
     *
     * @return void
     */
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        $params = ['email' => $email];

        $errors = [];

        if (!Validation::string($name, 2, 50))
            $errors['name'] = 'Name length must be between 2 and 50 characters';

        if (!Validation::email($email))
            $errors['email'] = 'Email must be valid';
        else
            $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user)
            $errors['email'] = 'That email is already registered';

        if (!Validation::string($password, 6, 50))
            $errors['password'] = 'Password must have atleast 6 characters';

        if (!Validation::match($password, $password_confirmation))
            $errors['password_confirmation'] = "The two passwords don't match";

        if (empty($errors)) {
            $params = [
                'name' => $name,
                'email' => $email,
                'city' => $city,
                'state' => $state,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];

            $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);
            redirect('/');
            return;
        } else {
            loadView('/users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                ],
            ]);
            return;
        }
    }
}
