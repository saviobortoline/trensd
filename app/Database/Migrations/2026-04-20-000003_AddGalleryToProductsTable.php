<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGalleryToProductsTable extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('gallery', 'products')) {
            return;
        }

        $fields = [
            'gallery' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'image',
            ],
        ];

        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        if (! $this->db->fieldExists('gallery', 'products')) {
            return;
        }

        $this->forge->dropColumn('products', 'gallery');
    }
}
