<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //logeadfo
        if (!session()->isLoggedIn) {
            return redirect()->to('/');
        }

        
        if (session()->get('role') !== 'admin') { //si es admin
            return redirect()->to('/tablero')->with('error', 'Acceso no autorizado.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}
