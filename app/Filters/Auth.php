<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        //var_dump($session->get('isLoggedIn'));die;
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login'); // Redirect to login page
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after response
    }
}