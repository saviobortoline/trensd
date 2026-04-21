<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToCategoriesTable extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('image', 'categories')) {
            return;
        }

        $fields = [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'description',
            ],
        ];

        $this->forge->addColumn('categories', $fields);
    }

    public function down()
    {
        if (! $this->db->fieldExists('image', 'categories')) {
            return;
        }

        $this->forge->dropColumn('categories', 'image');
    }
}
