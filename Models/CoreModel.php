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
}