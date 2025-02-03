<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Products extends Seeder
{
    public function run()
    {
        $data = [
            [
                'product_name' => '1 BLEND HOG PRE STARTER MASH (25KG)',
                'product_item' => 'PS1 (25KG)',
                'product_weight' => '25',
                'product_price' => 1160,
                'creator_id' => 1,
                'updater_id' => 1,
            ],
            [
                'product_name' => '1 BLEND HOG PRE STARTER MASH (50KG)',
                'product_item' => 'PS1 (50KG)',
                'product_weight' => '50',
                'product_price' => 2255,
                'creator_id' => 1,
                'updater_id' => 1,
            ],
            [
                'product_name' => '1 BLEND HOG STARTER MASH',
                'product_item' => 'HSM1',
                'product_weight' => '50',
                'product_price' => 1620,
                'creator_id' => 1,
                'updater_id' => 1,
            ],
            [
                'product_name' => 'TOP BREED PUPPY',
                'product_item' => 'TBP',
                'product_weight' => '25',
                'product_price' => 1647,
                'creator_id' => 1,
                'updater_id' => 1,
            ],
            [
                'product_name' => 'TOP BREED ADULT',
                'product_item' => 'TBA',
                'product_weight' => '25',
                'product_price' => 1367,
                'creator_id' => 1,
                'updater_id' => 1,
            ],
        ];

        // Using Query Builder
        $this->db->table('products')->insertBatch($data);
    }
}
