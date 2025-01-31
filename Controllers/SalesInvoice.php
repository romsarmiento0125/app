<?php

namespace App\Controllers;

use App\Models\CoreModel;

class SalesInvoice extends BaseController
{
    protected $coreModel;
    public function __construct()
    {
        $this->coreModel = new CoreModel();
    }

    public function index()
    {
        $session = session();
        $login = $session->get('login');
        if($login != 1) {
            return redirect()->to(base_url('login'));
        }
        return view('sales_invoice/sales_invoice');
    }

    public function get_products_clients() {
        $query1 = "SELECT * FROM products WHERE archive = 0";
        $query2 = "SELECT * FROM clients WHERE archive = 0";

        $products = $this->coreModel->get_csutom_query($query1);
        $clients = $this->coreModel->get_csutom_query($query2);
        
        return json_encode(['products' => $products, 'clients' => $clients]);
    }
}
