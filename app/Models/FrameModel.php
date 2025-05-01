<?php
namespace App\Models;

use CodeIgniter\Model;
class FrameModel extends Model
{
    protected $table = 'frames';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}