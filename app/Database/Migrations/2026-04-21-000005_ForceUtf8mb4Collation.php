<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ForceUtf8mb4Collation extends Migration
{
    public function up()
    {
        $database = (string) $this->db->database;

        if ($database !== '') {
            $safeDb = str_replace('`', '``', $database);
            $this->db->query(
                "ALTER DATABASE `{$safeDb}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
            );
        }

        $this->db->query(
            'ALTER TABLE categories CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );
        $this->db->query(
            'ALTER TABLE products CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );

        $fixes = [
            'Lumin?rias' => 'Luminárias',
            'lumin?rias' => 'luminárias',
            'pe?as' => 'peças',
            'Pe?as' => 'Peças',
            'ilumina??o' => 'iluminação',
            'Ilumina??o' => 'Iluminação',
            'decora??o' => 'decoração',
            'Decora??o' => 'Decoração',
            'produ??o' => 'produção',
            'Produ??o' => 'Produção',
        ];

        foreach ($fixes as $wrong => $right) {
            $w = $this->db->escapeString($wrong);
            $r = $this->db->escapeString($right);

            $this->db->query("UPDATE categories SET name = REPLACE(name, '{$w}', '{$r}')");
            $this->db->query("UPDATE categories SET description = REPLACE(description, '{$w}', '{$r}')");
            $this->db->query("UPDATE products SET name = REPLACE(name, '{$w}', '{$r}')");
            $this->db->query("UPDATE products SET description = REPLACE(description, '{$w}', '{$r}')");
        }
    }

    public function down()
    {
        $database = (string) $this->db->database;

        if ($database !== '') {
            $safeDb = str_replace('`', '``', $database);
            $this->db->query(
                "ALTER DATABASE `{$safeDb}` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci"
            );
        }

        $this->db->query(
            'ALTER TABLE categories CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci'
        );
        $this->db->query(
            'ALTER TABLE products CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci'
        );
    }
}
