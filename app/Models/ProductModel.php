<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['category_id', 'name', 'slug', 'description', 'price', 'image', 'gallery', 'stock', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getActive()
    {
        return $this->where('status', 'active')->orderBy('created_at', 'DESC')->findAll();
    }

    public function getActiveByCategory($categoryId)
    {
        return $this->where('status', 'active')
                    ->where('category_id', $categoryId)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function search($term)
    {
        return $this->where('status', 'active')
                    ->groupStart()
                        ->like('name', $term)
                        ->orLike('description', $term)
                    ->groupEnd()
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getFeatured($limit = 4)
    {
        return $this->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
