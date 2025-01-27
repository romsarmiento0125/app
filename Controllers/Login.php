<?php

namespace App\Controllers;

use App\Models\CoreModel;

class Login extends BaseController
{
    protected $coreModel;
    public function __construct()
    {
        $this->coreModel = new CoreModel();
    }

    public function index()
    {
        $data['hide_header'] = true;
        return view('login/login', $data);
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $user = $this->coreModel->get_csutom_query($query);

        if ($user) {
            if (password_verify($password, $user[0]->password)) {
                $session = session();
                $session->set('user_id', $user[0]->id);
                $session->set('username', $user[0]->username);
                $session->set('role', $user[0]->role_id);
                $session->set('login', 1);
                echo json_encode('success');
            }
            else {
                echo json_encode('error');
            }
        }

    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        echo json_encode('logout');
    }
}
