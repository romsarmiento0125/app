<?php

namespace App\Controllers;

use App\Models\CoreModel;

class Products extends BaseController
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
        return view('products/products');
    }

    public function get_table_products()
    {
        $query = "SELECT * FROM products WHERE archive = 0 LIMIT 1000";
        $products = $this->coreModel->get_csutom_query($query);
        return json_encode($products);
    }

    public function save_product()
    {
        $session = session();
        $user_id = $session->get('user_id');
        
        $product_name = $this->request->getPost('product_name');
        $product_item = $this->request->getPost('product_item');
        $product_weight = $this->request->getPost('product_weight');
        $product_price = $this->request->getPost('product_price');

        $query = "SELECT COUNT(*) as count FROM products WHERE (product_name = '$product_name' OR product_item = '$product_item') AND archive = 0";
        $result = $this->coreModel->get_csutom_query($query);
        if ($result[0]->count > 0) {
            return json_encode('exists');
        }

        $query = "INSERT INTO products (
            product_name,
            product_item,
            product_weight,
            product_price,
            creator_id,
            updater_id,
            archive
        ) VALUES (
            '$product_name',
            '$product_item',
            '$product_weight',
            '$product_price',
            '$user_id',
            '$user_id',
            0
        )";

        $insert = $this->coreModel->insert_custom_query($query);

        return json_encode($insert);
    }

    public function edit_product()
    {
        $session = session();
        $user_id = $session->get('user_id');
        
        $product_name = $this->request->getPost('product_name');
        $product_name_attr = $this->request->getPost('product_name_attr');
        $product_item = $this->request->getPost('product_item');
        $product_weight = $this->request->getPost('product_weight');
        $product_price = $this->request->getPost('product_price');

        $query = "UPDATE products SET 
            product_weight = '$product_weight',
            product_price = '$product_price',
            updater_id = '$user_id',
            updated_at = CURRENT_TIMESTAMP
            WHERE id = '$product_name_attr' AND product_name = '$product_name' AND product_item='$product_item' AND archive = 0";

        $update = $this->coreModel->update_custom_query($query);

        return json_encode($update);
    }
}
