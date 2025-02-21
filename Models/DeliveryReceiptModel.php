<?php
namespace App\Models;

use CodeIgniter\Model;

class DeliveryReceiptModel extends Model
{
    protected $db;

    public function __construct()
    {   
        $this->db = \Config\Database::connect();
    }

    public function get_products_clients_dr()
    {
        try {
            $productsQuery = "SELECT * FROM products WHERE archive = 0";
            $clientsQuery = "SELECT * FROM clients WHERE archive = 0";
            $delivery_receipt_query = "SELECT 
                    id,
                    client_name,
                    client_term,
                    dr_status,
                    dr_date
                FROM
                    delivery_receipt
                ORDER BY id DESC
                LIMIT 500";

            $products = $this->db->query($productsQuery)->getResult();
            $clients = $this->db->query($clientsQuery)->getResult();
            $delivery_receipt = $this->db->query($delivery_receipt_query)->getResult();

            return ['products' => $products, 'clients' => $clients, 'delivery_receipt' => $delivery_receipt];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_receipt_data($id)
    {
        try {
            $query = "SELECT 
                        c.client_name,
                        c.client_tin,
                        c.client_address,
                        c.client_business_name,
                        si.client_term AS client_term,
                        si.updated_at AS si_date,
                        si.vatable_sales,
                        si.vat_exempt_sales,
                        si.vat_amount,
                        si.total_amount_due,
                        si.freight_cost,
                        si_items.si_item_qty,
                        CONCAT(p.product_name,
                                ' ( ',
                                p.product_item,
                                ' )') AS product_name,
                        si_items.si_item_price AS unit_price,
                        (si_items.si_item_price * si_items.si_item_qty) AS amount,
                        si_items.id AS item_id,
                        si_items_discount.discount_label,
                        si_items_discount.discount
                    FROM sales_invoice si
                    LEFT JOIN sales_invoice_items_list si_items ON si.id = si_items.si_id
                    LEFT JOIN sales_invoice_items_list_discount si_items_discount ON si_items.id = si_items_discount.si_item_id
                    INNER JOIN products p ON si_items.si_item_code =  p.product_item
                    INNER JOIN clients c ON si.client_id = c.id
                    WHERE si.id = ? AND si.archive = 0 AND si_items.archive = 0";
            return $this->db->query($query, [$id])->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_delivery_receipt($data)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO delivery_receipt (
                client_id,
                client_name,
                client_tin,
                client_term,
                client_address,
                client_business_name,
                sub_total,
                freight_cost,
                total_amount,
                dr_status,
                creator_id,
                updater_id,
                archive,
                dr_date
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?)";

            $this->db->query($query, $data);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return 'failed';
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                $creator_id = $data[10]; // Assuming creator_id is the 10th element in the $data array
                $lastInsertQuery = $this->db->query("SELECT id FROM delivery_receipt WHERE creator_id = ? ORDER BY created_at DESC LIMIT 1", [$creator_id])->getResult();
                return $lastInsertQuery; // Return the last inserted ID and result
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function insert_delivery_receipt_items($params)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO delivery_receipt_items_list (
                dr_id,
                dr_item_code,
                dr_item_price,
                dr_item_qty,
                dr_unique_id,
                creator_id,
                updater_id,
                archive
            ) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";

            $this->db->query($query, $params);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return 'failed';
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                $unique_id = $params[4]; // Assuming unique_id is the 8th element in the $params array
                $lastInsertQuery = $this->db->query("SELECT id FROM delivery_receipt_items_list WHERE dr_unique_id = ? ORDER BY created_at DESC LIMIT 1", [$unique_id])->getResult();
                return $lastInsertQuery; // Return the last inserted ID and result
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function insert_delivery_receipt_items_discounts($discounts, $dr_item_id, $user_id)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO delivery_receipt_items_list_discount (
                dr_item_id,
                discount_label,
                discount,
                creator_id,
                updater_id,
                archive
            ) VALUES (?, ?, ?, ?, ?, 0)";

            foreach ($discounts as $discount) {
                if (empty($discount['label']) || $discount['discount'] == 0) {
                    continue; // Skip if label is blank or discount is 0
                }
                $params = [
                    $dr_item_id,
                    $discount['label'],
                    $discount['discount'],
                    $user_id,
                    $user_id
                ];
                $this->db->query($query, $params);
            }

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return 'failed';
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                return 'success';
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $e->getMessage();
        }
    }
    
}