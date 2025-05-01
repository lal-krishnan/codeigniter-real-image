<?php
namespace App\Models;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'price','agent_price'];
}