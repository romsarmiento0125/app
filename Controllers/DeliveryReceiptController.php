<?php

namespace App\Controllers;

use App\Models\CoreModel;

class DeliveryReceiptController extends BaseController
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
        return view('delivery_receipts/delivery_receipts');
    }

    
}
