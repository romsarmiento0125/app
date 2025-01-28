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
}