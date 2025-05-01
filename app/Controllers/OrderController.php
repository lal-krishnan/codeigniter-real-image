<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\WorkflowModel;
use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\MaterialModel;
use App\Models\FrameModel;
use App\Models\SizeModel;
use App\Models\TypeModel;
class OrderController extends BaseController
{
    public function index()
    {
        $reactAppPath = FCPATH . 'react-app/index.html';
       // echo $reactAppPath;die;
        if (file_exists($reactAppPath)) {
            echo file_get_contents($reactAppPath);
        } else {
            die("fil not found");
            show_404();
        }   
    }
    public function orderList()
    {
        $order = new Order();
        $orders = $order->findAll();
        return view('pages/order-list', [
            'orders' => $orders,
        ]);
    }
    public function viewOrder($id)
    {
        $order = new Order();
        $orderDetails = $order->find($id);
        $customerModel = new CustomerModel();
        $userModel = new UserModel();
        $workflowModel = new WorkflowModel();
        $materialModel = new MaterialModel();
        $frameModel = new FrameModel();
        $sizeModel = new SizeModel();
        $typeModel = new TypeModel();

        $orderDetails['customer'] = $customerModel->find($orderDetails['customer_id']);
        $orderDetails['assigned'] = $userModel->find($orderDetails['assigned_to']);
        $orderDetails['workflow'] = $workflowModel->find($orderDetails['workflow_id']);
        $orderDetails['material'] = $materialModel->find($orderDetails['material_id']);
        $orderDetails['frame'] = $frameModel->find($orderDetails['frame_id']);
        $orderDetails['size'] = $sizeModel->find($orderDetails['size_id']);
        $orderDetails['type'] = $typeModel->find($orderDetails['type_id']);
        $workflowList= $workflowModel->findAll();

        $userModel = new UserModel();
        $userList = $userModel->findAll();
        return view('pages/order-details', [
            'order' => $orderDetails,
            'workflowList' => $workflowList,
            'userList' => $userList,
        ]);
    }
    public function updateWorkFlow($id)
    {
        $order_id = $this->request->getPost('order_id');
        $workflow_id = $this->request->getPost('workflow_id');
        $assigned_to = $this->request->getPost('assigned_user');
        $order = new Order();
        $orderData = $order->find($order_id);
        $workflowModel = new WorkflowModel();
        $status= $this->request->getPost('status')? $this->request->getPost('status'):"In progress";
        
        $order->update($order_id, [
            'workflow_id' => $workflow_id,
            'status' => $status,
            'assigned_to' => $assigned_to,
        ]);
        return redirect()->to('/orders/view/'.$id)->with('success', 'Order updated successfully!');       
    }
    public function editOrder($id)
    { 
        $order = new Order();
        $orderDetails = $order->find($id);
        return view('pages/create-order', [
            'order' => $orderDetails,
        ]);
    }
    public function deleteOrder($id)
    {
        $order = new Order();
        $order->delete($id);
        return redirect()->to('/')->with('success', 'Order deleted successfully!');
    }
    public function updateOrder($id)
    {
        $order = new Order();
        $orderDetails = $order->find($id);
        if ($this->request->getMethod() === 'post') {
            $data = [
                'title' => $this->request->getPost('title'),
                'completion_date' => $this->request->getPost('completion_date'),
                'description' => $this->request->getPost('description'),
            ];
            $order->update($id, $data);
            return redirect()->to('/')->with('success', 'Order updated successfully!');
        }
        return view('pages/edit-order', [
            'order' => $orderDetails,
        ]);
    }
    public function create()
    {        
        $workflowModel = new WorkflowModel();
        $workflows = $workflowModel->findAll();
        $materials= new MaterialModel();
        $materialList = $materials->findAll();
        $frameModel = new FrameModel();
        $frameList = $frameModel->findAll();
        $sizeModel = new SizeModel();
        $sizeList = $sizeModel->findAll();
        $typeModel = new TypeModel();
        $typeList = $typeModel->findAll();
        $userModel = new UserModel();
        $userList = $userModel->findAll();
        $user_id = session()->get('user_id');
        $user = $userModel->find($user_id);
        return view('pages/create-order',compact('workflows','materialList','frameList','sizeList','typeList','userList',
    'user'));
    }
    public function submitOrder()
    {
         $validation = \Config\Services::validation();

        $validation->setRules([
            'title' => 'required|min_length[1]',
            'completion_date' => 'required',
            'description' => 'required|min_length[1]',
        ]);
        if ( $validation->withRequest($this->request)->run()
        ) {
            $order= new Order;
            $arr=[
                'title' => $this->request->getPost('title'),
                'completion_date' => $this->request->getPost('completion_date'),
                'description' => $this->request->getPost('description'),
            ];
          //  print_r($arr);die;
            $ord=$order->save([
                'title' => $this->request->getPost('title'),
                'completion_date' => $this->request->getPost('completion_date'),
                'description' => $this->request->getPost('description'),
                'customer_id'=>$this->request->getPost('customer_id'),
                'order_date'=>date('Y-m-d H:i:s'),
                'status'=>'Pending',
                'total_amount'=>$this->request->getPost('customer_id'),
                'workflow_id'=>$this->request->getPost('workflow_id'),
                'material_id'=>$this->request->getPost('material_id'),
                'frame_id'=>$this->request->getPost('frame_id'),
                'size_id'=>$this->request->getPost('size_id'),
                'type_id'=>$this->request->getPost('type_id'),
                'assigned_to'=>$this->request->getPost('assigned_to'),
            ]);  
            $id=$order->getInsertID();  
            $order->update($id, [
                'serial' => '1111'.$id,
            ]);
           
            return redirect()->to('/orders/view/'.$id)->with('success', 'Order created successfully!');
        }
        return view('pages/create-order', [
            'validation' => $validation,
        ]);
    }
}
