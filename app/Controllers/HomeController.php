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
class HomeController extends BaseController
{
    // public function index()
    // {
    //     $reactAppPath = FCPATH . 'react-app/index.html';
    //    // echo $reactAppPath;die;
    //     if (file_exists($reactAppPath)) {
    //         echo file_get_contents($reactAppPath);
    //     } else {
    //         die("fil not found");
    //         show_404();
    //     }   
    // }
    public function index()
    {
        $order = new Order();
        $userId = session()->get('user_id');
        $orders = $order->where('assigned_to', $userId)->findAll();
        $order = new Order();
        $pendingOrders = $order->select('orders.*, workflows.title as workflow_name,customers.name as customer_name')
                ->join('workflows', 'orders.workflow_id = workflows.id', 'left')
                ->join('customers', 'orders.customer_id = customers.id', 'left')
                ->where('assigned_to', $userId)
                ->where('status', 'Pending')
                ->findAll();
        $inProgressOrders = $order->select('orders.*, workflows.title as workflow_name,customers.name as customer_name')
                ->join('workflows', 'orders.workflow_id = workflows.id', 'left')
                ->join('customers', 'orders.customer_id = customers.id', 'left')
                ->where('assigned_to', $userId)
                ->where('status', 'In Progress')
                ->findAll();
         $completedOrders = $order->select('orders.*, workflows.title as workflow_name,customers.name as customer_name')
                ->join('workflows', 'orders.workflow_id = workflows.id', 'left')
                ->join('customers', 'orders.customer_id = customers.id', 'left')
                ->where('assigned_to', $userId)
                ->where('status', 'Completed')
                ->findAll();
        return view('pages/home',compact('pendingOrders','inProgressOrders','completedOrders'));
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
        $orderDetails['user'] = $userModel->find($orderDetails['user_id']);
        $orderDetails['workflow'] = $workflowModel->find($orderDetails['workflow_id']);
        $orderDetails['material'] = $materialModel->find($orderDetails['material_id']);
        $orderDetails['frame'] = $frameModel->find($orderDetails['frame_id']);
        $orderDetails['size'] = $sizeModel->find($orderDetails['size_id']);
        $orderDetails['type'] = $typeModel->find($orderDetails['type_id']);
        $workflowList= $workflowModel->findAll();
        return view('pages/order-details', [
            'order' => $orderDetails,
            'workflowList' => $workflowList,
        ]);
    }
    public function updateWorkFlow($id)
    {
        $order = new Order();
        $orderData = $order->find($id);
        $workflowModel = new WorkflowModel();
        $workflowList = $workflowModel->findAll();
        $currentWorkflow = $orderData['workflow_id'];
        $currentWorkflowIndex = array_search($currentWorkflow, array_column($workflowList, 'id'));
        $nextWorkflowIndex = $currentWorkflowIndex + 1;
        if ($nextWorkflowIndex >= count($workflowList)) {
            return redirect()->to('/orders/view/'.$id)->with('error', 'No more workflows available.');
        }
        $nextWorkflow = $workflowList[$nextWorkflowIndex];
        $order->update($id, [
            'workflow_id' => $nextWorkflow['id'],
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

        return view('pages/create-order',compact('workflows','materialList','frameList','sizeList','typeList'));
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
                'status'=>'pending',
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
