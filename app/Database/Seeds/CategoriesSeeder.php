<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Setup', 'slug' => 'setup', 'description' => 'Equipamentos para seu workspace'],
            ['name' => 'Chaveiro', 'slug' => 'chaveiro', 'description' => 'Chaveiros personalizados únicos'],
            ['name' => 'Novidades', 'slug' => 'novidades', 'description' => 'Os últimos lançamentos'],
            ['name' => 'Bustos', 'slug' => 'bustos', 'description' => 'Esculturas e peças decorativas'],
            ['name' => 'Vasos', 'slug' => 'vasos', 'description' => 'Vasos e recipientes personalizados'],
            ['name' => 'Alexa', 'slug' => 'alexa', 'description' => 'Acessórios e suportes inteligentes'],
        ];

        foreach ($data as $row) {
            $this->db->table('categories')->insert($row);
        }
    }
}
