<?php

namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
	public function index()
	{
		echo "Lista de usuarios";
		exit();
	}

	public function view($name)
	{
		echo "Detaller de usuario" . $name;
		exit();
	}

	public function add()
	{
		echo "Agregar usuario";
		exit();
	}
}