<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\WorkflowModel;
use App\Models\UserModel;
use App\Models\CustomerModel;
//use App\Models\RoleModel;
class CustomerController extends BaseController
{
    
    public function getUserByMobile()
    {
        $customerModel = new CustomerModel();
        $mobile = $this->request->getPost('mobile_number');
        $customer = $customerModel->where('phone', $mobile)->first();
        if ($customer) {
            return $this->response->setJSON($customer);
        } else {
            return $this->response->setJSON(['error' => 'Customer not found']);
        }
    }   
}
