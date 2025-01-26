<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $data['hide_header'] = true;
        return view('login/login', $data);
    }
}
