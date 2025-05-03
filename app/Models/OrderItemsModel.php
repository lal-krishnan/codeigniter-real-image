<?php
namespace App\Models;

use CodeIgniter\Model;

class OrderItemsModel extends Model
{
    protected $table = 'order_items'; // Table name
    protected $primaryKey = 'id'; // Primary key

    protected $useAutoIncrement = true; // Auto-increment primary key
    protected $returnType = 'array'; // Return type (array or object)
    protected $useSoftDeletes = true; // Enable soft deletes

    protected $allowedFields = [   
        'status',
        'assigned_to',
        'order_id',
        'amount_item',
        'workflow_id',
        'assigned_to',
        'material_id',
        'frame_id',
        'size_id',
        'type_id',
        'description',
        'title',
        'completion_date',
        'serial',
        'quantity'
    ]; // Fields that can be inserted/updated

    protected $useTimestamps = true; // Enable created_at and updated_at
    protected $createdField = 'created_at'; // Created timestamp field
    protected $updatedField = 'updated_at'; // Updated timestamp field
    protected $deletedField = 'deleted_at'; // Soft delete timestamp field
}