<?php

namespace App\Controllers;

use App\Models\UserModel;

class Authentication extends BaseController
{
    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];

            if ($this->validate($rules)) {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getPost('email'))->first();

                if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                    session()->set([
                        'user_id' => $user['id'],
                        'email'   => $user['email'],
                        'isLoggedIn' => true,
                    ]);
                    return redirect()->to('/orders');
                } else {
                    $data['error'] = 'Invalid email or password.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }


        return view('pages/auth/login', $data);
    }

    public function register()
    {
        helper(['form']);
        $data = [];
       // print_r($this->request->getPost());die;
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'name'     => 'required|min_length[3]',
                'email'    => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'matches[password]',
            ];

            if ($this->validate($rules)) {
                $model = new UserModel();
                $model->save([
                    'name'     => $this->request->getPost('name'),
                    'email'    => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                ]);
                return redirect()->to('/login');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('pages/auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}