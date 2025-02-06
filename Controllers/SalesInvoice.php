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

    public function save_draft() {
        $session = session();
        $user_id = $session->get('user_id');

        $data = $this->request->getJSON(true);

        // Extract summary data
        $summaryData = $data['summary'];
        $totalAmount = $summaryData['totalAmount'];
        $vatableSales = $summaryData['vatableSales'];
        $vatAmount = $summaryData['vatAmount'];
        $totalAmountDue = $summaryData['totalAmountDue'];
        $vatExemptSales = $summaryData['vatExemptSales'];
        $zeroRated = $summaryData['zeroRated'];
        $freightCost = $summaryData['freightCost'];

        // Extract customer data
        $customerDetail = $data['customer'];
        $customerId = $customerDetail['id'];
        $customerTerms = $customerDetail['terms'];
        $customerDate = $customerDetail['date'];

        // Extract items data
        $items = $data['items'];

        $params = [
            $customerId,
            $customerTerms,
            $customerDate,
            $vatableSales,
            $vatExemptSales,
            $zeroRated,
            $vatAmount,
            $totalAmountDue,
            $freightCost,
            $totalAmount,
            $user_id,
            $user_id
        ];

        $insertResult = $this->coreModel->insert_sales_invoice($params);

        if (is_array($insertResult) && !empty($insertResult)) {
            $insertId = $insertResult[0]->id; // Access the ID from the result

            foreach ($items as $item) {
                $params = [
                    $insertId,
                    $item['item_code'],
                    $item['item_price'],
                    $item['item_qty'],
                    $item['item_vat'],
                    $item['item_vat_check'],
                    $item['item_vatable_sales'],
                    $item['unique_id']
                ];
                $lastItemResult = $this->coreModel->insert_sales_invoice_items($params);

                if (isset($item['item_discount'])) {
                    $si_item_id = $lastItemResult[0]->id; // Get the last inserted ID for the item
                    $this->coreModel->insert_sales_invoice_items_discounts($item['item_discount'], $si_item_id);
                }
            }

            return json_encode(['invoice_id' => $insertId, 'items' => $params, 'lastItem' => $lastItemResult]);
        } else {
            return json_encode(['invoice' => $insertResult]);
        }
    }
}
