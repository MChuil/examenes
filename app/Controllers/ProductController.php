<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        echo "Listado de productos";
    }

    public function show($id){
        echo "<h2>Detalle de producto con id: $id</h2>";
    }
}

/**
 * index
 * show
 * create
 * store
 * edit
 * update
 * delete
 */
