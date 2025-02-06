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

    public function get_csutom_query($query)
    {
        try {
            return $this->db->query($query)->getResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_custom_query($query)
    {
        try {
            $this->db->transStart(); // Start Transaction
            $this->db->query($query);
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

    public function update_custom_query($query)
    {
        try {
            $this->db->transStart(); // Start Transaction
            $this->db->query($query);
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
                creator_id,
                updater_id,
                archive
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";

            $result = $this->db->query($query, $data);

            $this->db->transComplete(); // Complete Transaction

            if ($this->db->transStatus() === false) {
                // Transaction failed, rollback
                $this->db->transRollback();
                return 'failed';
            } else {
                // Transaction successful, commit
                $this->db->transCommit();
                $creator_id = $data[10]; // Assuming creator_id is the 11th element in the $data array
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
            // Rollback transaction in case of exception
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
            // Rollback transaction in case of exception
            $this->db->transRollback();
            return $e->getMessage();
        }
    }
}