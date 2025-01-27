<?php

namespace App\Controllers;

class SalesInvoice extends BaseController
{
    public function index()
    {
        $session = session();
        $login = $session->get('login');
        if($login != 1) {
            return redirect()->to(base_url('login'));
        }
        return view('sales_invoice/sales_invoice');
    }
}
