<?php
namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders'; // Table name
    protected $primaryKey = 'id'; // Primary key

    protected $useAutoIncrement = true; // Auto-increment primary key
    protected $returnType = 'array'; // Return type (array or object)
    protected $useSoftDeletes = true; // Enable soft deletes

    protected $allowedFields = [
        'customer_id',
        'order_date',
        'status',
        'total_amount',
        'workflow_id',
        'assigned_to',
        'material_id',
        'frame_id',
        'size_id',
        'type_id',
        'description',
        'title',
        'completion_date',
        'serial'

    ]; // Fields that can be inserted/updated

    protected $useTimestamps = true; // Enable created_at and updated_at
    protected $createdField = 'created_at'; // Created timestamp field
    protected $updatedField = 'updated_at'; // Updated timestamp field
    protected $deletedField = 'deleted_at'; // Soft delete timestamp field

    protected $validationRules = [
       'customer_id' => 'required|integer',
       'order_date' => 'required|valid_date',
       'status' => 'required|string|max_length[50]',
       'total_amount' => 'required|decimal',
    ]; // Validation rules

    protected $validationMessages = []; // Custom validation messages
    protected $skipValidation = false; // Skip validation

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class, 'workflow_id', 'id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class, 'frame_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}