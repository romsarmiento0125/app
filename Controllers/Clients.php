<?php

namespace App\Controllers;

use App\Models\CoreModel;

class Clients extends BaseController
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
        return view('clients/clients');
    }

    public function get_table_clients()
    {
        $query = "SELECT * FROM clients WHERE archive = 0 LIMIT 1000";
        $products = $this->coreModel->get_csutom_query($query);
        return json_encode($products);
    }

    public function save_client()
    {
        $session = session();
        $user_id = $session->get('user_id');
        
        $client_name = $this->request->getPost('client_name');
        $client_tin = $this->request->getPost('client_tin');
        $client_business_name = $this->request->getPost('client_business_name');
        $client_term = $this->request->getPost('client_term');
        $client_address = $this->request->getPost('client_address');

        $query = "SELECT COUNT(*) as count FROM clients WHERE client_name = '$client_name' AND archive = 0";
        $result = $this->coreModel->get_csutom_query($query);
        if ($result[0]->count > 0) {
            return json_encode('exists');
        }

        $query = "INSERT INTO clients (
            client_name,
            client_tin,
            client_address,
            client_business_name,
            client_term,
            creator_id,
            updater_id,
            archive
        ) VALUES (
            '$client_name',
            '$client_tin',
            '$client_address',
            '$client_business_name',
            '$client_term',
            '$user_id',
            '$user_id',
            0
        )";

        $insert = $this->coreModel->insert_custom_query($query);

        return json_encode($insert);
    }

    public function edit_client()
    {
        $session = session();
        $user_id = $session->get('user_id');
        
        $client_name = $this->request->getPost('client_name');
        $client_name_attr = $this->request->getPost('client_name_attr');
        $client_tin = $this->request->getPost('client_tin');
        $client_business_name = $this->request->getPost('client_business_name');
        $client_term = $this->request->getPost('client_term');
        $client_address = $this->request->getPost('client_address');

        $query = "UPDATE clients SET 
            client_name = '$client_name',
            client_tin = '$client_tin',
            client_address = '$client_address',
            client_business_name = '$client_business_name',
            client_term = '$client_term',
            updater_id = '$user_id',
            updated_at = CURRENT_TIMESTAMP
            WHERE id = '$client_name_attr' AND archive = 0";

        $update = $this->coreModel->update_custom_query($query);

        return json_encode($update);
    }
}
