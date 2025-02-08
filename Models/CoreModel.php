<?php
namespace App\Models;

use CodeIgniter\Model;

class CoreModel extends Model
{
    protected $db;

    public function __construct()
    {   
        $this->db = \Config\Database::connect();
    }

    public function user_login($username)
    {
        try {
            $query = "SELECT * FROM users WHERE username = ?";
            return $this->db->query($query, [$username])->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_clients()
    {
        try {
            $query = "SELECT * FROM clients WHERE archive = 0 LIMIT 1000";
            return $this->db->query($query)->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function check_client_exists($client_name)
    {
        try {
            $query = "SELECT COUNT(*) as count FROM clients WHERE client_name = ? AND archive = 0";
            return $this->db->query($query, [$client_name])->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_client($params)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO clients (
                client_name,
                client_tin,
                client_address,
                client_business_name,
                client_term,
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
                return 'success';
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function update_client($params)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "UPDATE clients SET 
                client_name = ?,
                client_tin = ?,
                client_address = ?,
                client_business_name = ?,
                client_term = ?,
                updater_id = ?,
                updated_at = CURRENT_TIMESTAMP
                WHERE id = ? AND archive = 0";

            $this->db->query($query, $params);

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
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function insert_sales_invoice($data)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO sales_invoice (
                client_id,
                client_term,
                client_date,
                vatable_sales,
                vat_exempt_sales,
                zero_rated,
                vat_amount,
                total_amount_due,
                freight_cost,
                total_amount,
                si_status,
                creator_id,
                updater_id,
                archive
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";

            $result = $this->db->query($query, $data);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return 'failed';
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                $creator_id = $data[11]; // Assuming creator_id is the 11th element in the $data array
                $lastInsertQuery = $this->db->query("SELECT id FROM sales_invoice WHERE creator_id = ? ORDER BY created_at DESC LIMIT 1", [$creator_id])->getResult();
                return $lastInsertQuery; // Return the last inserted ID and result
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function insert_sales_invoice_items($params)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO sales_invoice_items_list (
                si_id,
                si_item_code,
                si_item_price,
                si_item_qty,
                si_item_vat,
                si_item_vat_check,
                si_item_vatable_sales,
                si_unique_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($query, $params);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return 'failed';
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                $unique_id = $params[7]; // Assuming unique_id is the 8th element in the $params array
                $lastInsertQuery = $this->db->query("SELECT id FROM sales_invoice_items_list WHERE si_unique_id = ? ORDER BY created_at DESC LIMIT 1", [$unique_id])->getResult();
                return $lastInsertQuery; // Return the last inserted ID and result
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function insert_sales_invoice_items_discounts($discounts, $si_item_id)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO sales_invoice_items_list_discount (
                si_item_id,
                discount_label,
                discount
            ) VALUES (?, ?, ?)";

            foreach ($discounts as $discount) {
                if (empty($discount['label']) || $discount['discount'] == 0) {
                    continue; // Skip if label is blank or discount is 0
                }
                $params = [
                    $si_item_id,
                    $discount['label'],
                    $discount['discount']
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

    public function get_products_clients_si()
    {
        try {
            $productsQuery = "SELECT * FROM products WHERE archive = 0";
            $clientsQuery = "SELECT * FROM clients WHERE archive = 0";
            $sales_invoice_query = "SELECT 
                    si.id,
                    c.client_name,
                    si.client_term,
                    si.client_date,
                    si.si_status
                FROM
                    sales_invoice si
                        INNER JOIN
                    clients c ON si.client_id = c.id";

            $products = $this->db->query($productsQuery)->getResult();
            $clients = $this->db->query($clientsQuery)->getResult();
            $sales_invoice = $this->db->query($sales_invoice_query)->getResult();

            return ['products' => $products, 'clients' => $clients, 'sales_invoice' => $sales_invoice];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_products()
    {
        try {
            $query = "SELECT * FROM products WHERE archive = 0 LIMIT 1000";
            return $this->db->query($query)->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function check_product_exists($product_name, $product_item)
    {
        try {
            $query = "SELECT COUNT(*) as count FROM products WHERE (product_name = ? OR product_item = ?) AND archive = 0";
            return $this->db->query($query, [$product_name, $product_item])->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_product($params)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "INSERT INTO products (
                product_name,
                product_item,
                product_weight,
                product_price,
                creator_id,
                updater_id,
                archive
            ) VALUES (?, ?, ?, ?, ?, ?, 0)";

            $this->db->query($query, $params);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return ['status' => 'failed', 'message' => 'Transaction failed'];
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                return ['status' => 'success', 'message' => 'Product added successfully'];
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function update_product($params)
    {
        try {
            $this->db->transStart(); // Start Transaction

            $query = "UPDATE products SET 
                product_name = ?,
                product_item = ?,
                product_weight = ?,
                product_price = ?,
                updater_id = ?,
                updated_at = CURRENT_TIMESTAMP
                WHERE id = ? AND archive = 0";

            $this->db->query($query, $params);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return ['status' => 'failed', 'message' => 'Transaction failed'];
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                return ['status' => 'success', 'message' => 'Product updated successfully'];
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function get_sales_invoice_by_id($id)
    {
        try {
            $query = "SELECT 
                        si.*, 
                        c.client_name, 
                        c.client_tin, 
                        c.client_address, 
                        c.client_business_name,
                        p.id AS si_item_id, 
                        si_items.si_item_code, 
                        si_items.si_item_price, 
                        si_items.si_item_qty, 
                        si_items.si_item_vat, 
                        si_items.si_item_vat_check, 
                        si_items.si_item_vatable_sales, 
                        si_items.si_unique_id,
                        si_items_discount.discount_label, 
                        si_items_discount.discount
                    FROM sales_invoice si
                    INNER JOIN clients c ON si.client_id = c.id
                    LEFT JOIN sales_invoice_items_list si_items ON si.id = si_items.si_id
                    LEFT JOIN sales_invoice_items_list_discount si_items_discount ON si_items.id = si_items_discount.si_item_id
                    INNER JOIN products p ON si_items.si_item_code =  p.product_item
                    WHERE si.id = ?";
            return $this->db->query($query, [$id])->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}