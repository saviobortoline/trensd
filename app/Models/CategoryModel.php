<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['name', 'slug', 'description', 'image'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getAllActive()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    public function search($term)
    {
        return $this->groupStart()
                    ->like('name', $term)
                    ->orLike('description', $term)
                ->groupEnd()
                ->orderBy('name', 'ASC')
                ->findAll();
    }
}
