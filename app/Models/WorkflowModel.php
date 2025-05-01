<?php
namespace App\Models;
use CodeIgniter\Model;
class WorkflowModel extends Model
{
    protected $table = 'workflows';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'priority', 'role'];
    protected $useTimestamps = false; // Enable if your table has created_at and updated_at fields
}