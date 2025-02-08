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
        $products = $this->coreModel->get_products();
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

        $result = $this->coreModel->check_product_exists($product_name, $product_item);
        if (is_string($result)) {
            return json_encode(['status' => 'error', 'message' => $result]);
        }
        if ($result[0]->count > 0) {
            return json_encode(['status' => 'exists', 'message' => 'Product already exists']);
        }

        $params = [
            $product_name,
            $product_item,
            $product_weight,
            $product_price,
            $user_id,
            $user_id
        ];

        $insert = $this->coreModel->insert_product($params);
        if (!$insert) {
            return json_encode(['status' => 'error', 'message' => 'Failed to save product']);
        }
        return json_encode(['status' => 'success', 'message' => 'Product saved successfully']);
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

        $params = [
            $product_name,
            $product_item,
            $product_weight,
            $product_price,
            $user_id,
            $product_name_attr
        ];

        $update = $this->coreModel->update_product($params);
        if (!$update) {
            return json_encode(['status' => 'error', 'message' => 'Failed to update product']);
        }
        return json_encode(['status' => 'success', 'message' => 'Product updated successfully']);
    }
}
