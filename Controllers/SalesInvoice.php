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

    public function get_products_clients_si() {
        $result = $this->coreModel->get_products_clients_si();
        
        if (is_string($result)) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $result]);
        }

        return json_encode($result);
    }

    public function save_draft() {
        $session = session();
        $user_id = $session->get('user_id');

        $data = $this->request->getJSON(true);

        // Validate data
        if (empty($data['summary']) || empty($data['customer']) || empty($data['items'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid data. Please fill in all required fields.']);
        }

        // Extract summary data
        $summaryData = $data['summary'];
        $totalAmount = $summaryData['totalAmount'];
        $vatableSales = $summaryData['vatableSales'];
        $vatAmount = $summaryData['vatAmount'];
        $totalAmountDue = $summaryData['totalAmountDue'];
        $vatExemptSales = $summaryData['vatExemptSales'];
        $zeroRated = $summaryData['zeroRated'];
        $freightCost = $summaryData['freightCost'];
        $si_status = $summaryData['si_status'];

        // Extract customer data
        $customerDetail = $data['customer'];
        $customerId = $customerDetail['id'];
        $customerTerms = $customerDetail['terms'];

        // Extract items data
        $items = $data['items'];

        $params = [
            $customerId,
            $customerTerms,
            $vatableSales,
            $vatExemptSales,
            $zeroRated,
            $vatAmount,
            $totalAmountDue,
            $freightCost,
            $totalAmount,
            $si_status,
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

    public function update_draft() {
        $session = session();
        $user_id = $session->get('user_id');

        $data = $this->request->getJSON(true);

        // Validate data
        if (empty($data['summary']) || empty($data['customer']) || empty($data['items'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid data. Please fill in all required fields.']);
        }

        // Extract summary data
        $summaryData = $data['summary'];
        $totalAmount = $summaryData['totalAmount'];
        $vatableSales = $summaryData['vatableSales'];
        $vatAmount = $summaryData['vatAmount'];
        $totalAmountDue = $summaryData['totalAmountDue'];
        $vatExemptSales = $summaryData['vatExemptSales'];
        $zeroRated = $summaryData['zeroRated'];
        $freightCost = $summaryData['freightCost'];
        $si_status = $summaryData['si_status'];

        // Extract customer data
        $customerDetail = $data['customer'];
        $customerId = $customerDetail['id'];
        $customerTerms = $customerDetail['terms'];

        // Extract items data
        $items = $data['items'];

        $params = [
            $customerId,
            $customerTerms,
            $vatableSales,
            $vatExemptSales,
            $zeroRated,
            $vatAmount,
            $totalAmountDue,
            $freightCost,
            $totalAmount,
            $si_status,
            $user_id,
            $data['si_id'] // Add the sales invoice ID for updating
        ];

        
        $updateResult = $this->coreModel->update_sales_invoice($params);
        
        if ($updateResult === 'success') {
            foreach ($items as $item) { 
                if($item['id'] === 0) {
                    $params = [
                        $data['si_id'],
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
                else {
                    $params = [
                        $item['item_code'],
                        $item['item_price'],
                        $item['item_qty'],
                        $item['item_vat'],
                        $item['item_vat_check'],
                        $item['item_vatable_sales'],
                        $item['id']
                    ];
                    $result = $this->coreModel->update_sales_invoice_items($params);

                    if (isset($item['item_discount'])) {
                        $si_item_id = $item['id']; // Get the last inserted ID for the item
                        $this->coreModel->update_sales_invoice_items_discounts($item['item_discount'], $si_item_id);
                    }
                }

            }

            return json_encode(['status' => 'success']);
        } else {
            return json_encode(['status' => 'failed', 'message' => $updateResult]);
        }
    }

    function get_sales_invoice_by_id() {
        $id = $this->request->getJSON(true);

        $result = $this->coreModel->get_sales_invoice_by_id($id);

        if (is_string($result)) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $result]);
        }
        

        $salesInvoice = [];
        $items = [];
        $discounts = [];

        foreach ($result as $row) {
            if (empty($salesInvoice)) {
                $salesInvoice = [
                    'id' => $row->id,
                    'client_id' => $row->client_id,
                    'client_term_name' => $row->client_term,
                    'si_status' => $row->si_status,
                    'freight_cost' => $row->freight_cost,
                    'items' => []
                ];
            }

            $itemId = $row->si_unique_id;
            if (!isset($items[$itemId])) {
                $items[$itemId] = [
                    'si_item_id' => (int) $row->si_item_id,
                    'product_id' => $row->product_id,
                    'si_item_code' => $row->si_item_code,
                    'si_item_price' => $row->si_item_price,
                    'si_item_qty' => $row->si_item_qty,
                    'si_item_vat' => $row->si_item_vat,
                    'si_item_vat_check' => $row->si_item_vat_check,
                    'si_item_vatable_sales' => $row->si_item_vatable_sales,
                    'si_unique_id' => (int) $row->si_unique_id,
                    'discounts' => []
                ];
            }

            if ($row->discount_label) {
                $items[$itemId]['discounts'][] = [
                    'label' => $row->discount_label,
                    'discount' => $row->discount
                ];
            }
        }

        $salesInvoice['items'] = array_values($items);

        return json_encode($salesInvoice);
    }
}
