<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Setup
            ['category_id' => 1, 'name' => 'Fone Gamer RGB', 'slug' => 'fone-gamer-rgb', 'description' => 'Fone gamer com LED RGB', 'price' => 189.90, 'stock' => 10, 'status' => 'active'],
            ['category_id' => 1, 'name' => 'Mouse Óptico', 'slug' => 'mouse-optico', 'description' => 'Mouse com sensor óptico de alta precisão', 'price' => 79.90, 'stock' => 15, 'status' => 'active'],
            ['category_id' => 1, 'name' => 'Teclado Mecânico', 'slug' => 'teclado-mecanico', 'description' => 'Teclado mecânico RGB', 'price' => 299.90, 'stock' => 8, 'status' => 'active'],
            
            // Chaveiro
            ['category_id' => 2, 'name' => 'Chaveiro Emborrachado', 'slug' => 'chaveiro-emborrachado', 'description' => 'Chaveiro com borracha colorida', 'price' => 29.90, 'stock' => 50, 'status' => 'active'],
            ['category_id' => 2, 'name' => 'Chaveiro Metálico', 'slug' => 'chaveiro-metalico', 'description' => 'Chaveiro em metal com acabamento brilhante', 'price' => 49.90, 'stock' => 30, 'status' => 'active'],
            ['category_id' => 2, 'name' => 'Chaveiro de Couro', 'slug' => 'chaveiro-couro', 'description' => 'Chaveiro em couro legítimo', 'price' => 89.90, 'stock' => 20, 'status' => 'active'],
            
            // Novidades
            ['category_id' => 3, 'name' => 'Luminária LED', 'slug' => 'luminaria-led', 'description' => 'Luminária com controle de intensidade', 'price' => 129.90, 'stock' => 12, 'status' => 'active'],
            ['category_id' => 3, 'name' => 'Relógio Digital', 'slug' => 'relogio-digital', 'description' => 'Relógio digital com alarme', 'price' => 159.90, 'stock' => 5, 'status' => 'active'],
            
            // Bustos
            ['category_id' => 4, 'name' => 'Busto Clássico Pequeno', 'slug' => 'busto-classico-pequeno', 'description' => 'Busto em gesso tamanho pequeno', 'price' => 199.90, 'stock' => 6, 'status' => 'active'],
            ['category_id' => 4, 'name' => 'Busto Clássico Grande', 'slug' => 'busto-classico-grande', 'description' => 'Busto em gesso tamanho grande', 'price' => 349.90, 'stock' => 3, 'status' => 'active'],
            
            // Vasos
            ['category_id' => 5, 'name' => 'Vaso Decorativo', 'slug' => 'vaso-decorativo', 'description' => 'Vaso em porcelana branca', 'price' => 89.90, 'stock' => 8, 'status' => 'active'],
            ['category_id' => 5, 'name' => 'Vaso com Padrão', 'slug' => 'vaso-padrao', 'description' => 'Vaso com padrão geométrico', 'price' => 119.90, 'stock' => 4, 'status' => 'active'],
            
            // Alexa
            ['category_id' => 6, 'name' => 'Suporte Alexa', 'slug' => 'suporte-alexa', 'description' => 'Suporte de parede para Alexa', 'price' => 79.90, 'stock' => 20, 'status' => 'active'],
            ['category_id' => 6, 'name' => 'Protetor Alexa', 'slug' => 'protetor-alexa', 'description' => 'Capa protetora para Alexa', 'price' => 49.90, 'stock' => 25, 'status' => 'active'],
        ];

        foreach ($products as $row) {
            $this->db->table('products')->insert($row);
        }
    }
}
