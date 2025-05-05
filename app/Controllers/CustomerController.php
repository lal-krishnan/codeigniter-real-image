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
    public function createCustomer()
    {
        $customerModel = new CustomerModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ];
        
        if ($customerModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'customer_id' => $customerModel->insertID(), 'mobile' => $data['phone']]);  
        } else {
            return $this->response->setJSON(['error' => 'Failed to create customer']);
        }
    }
}
