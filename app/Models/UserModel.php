<?php

namespace App\Models;
use CodeIgniter\Model;


class UserModel extends Model
{
    protected $table = 'users'; // Table name
    protected $primaryKey = 'id'; // Primary key

    protected $useAutoIncrement = true;

    protected $returnType = 'array'; // Return data as an array
    protected $useSoftDeletes = true; // Enable soft deletes

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at'
    ]; // Fields that can be inserted/updated

    protected $useTimestamps = true; // Automatically handle created_at and updated_at
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name' => 'required|min_length[1]|max_length[50]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]'
    ]; // Validation rules

    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * Hash the password before saving it to the database.
     */
    protected function beforeInsert(array $data)
    {
        $data = $this->hashPassword($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->hashPassword($data);
        return $data;
    }

    private function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}