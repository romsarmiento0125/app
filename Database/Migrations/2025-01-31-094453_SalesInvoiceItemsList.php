<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SalesInvoiceItemsList extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' =>11,
                'auto_increment' => true
            ],
            'client_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'item_term' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'product_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'product_weight' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'product_price' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'creator_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'updater_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'archive' => [
                'type' => 'BOOLEAN',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp'
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sales_inovice_items_list');
    }

    public function down()
    {
        $this->forge->dropTable('sales_inovice_items_list');
    }
}
