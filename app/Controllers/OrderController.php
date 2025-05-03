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
use App\Models\OrderItemsModel;
class OrderController extends BaseController
{
    
    public function index()
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
        $mode='create';
        return view('pages/order/line-items',compact('mode','workflows','materialList','frameList','sizeList','typeList','userList',
    'user')); 
    }
   
    public function loadLineHTML()
    {
        $html='';
        for($i=0;$i<5;$i++){
            $html.= view('pages/order/line');
        }
        return $html;
    }
    public function submitOrderLines()
    {
        $orderItemsModel = new OrderItemsModel();
        $order= new Order;
        $arr=[
            'title' => "",
            'completion_date' => $this->request->getPost('completion_date'),
            'description' => $this->request->getPost('description'),
        ];
        $customer_id=$this->request->getPost('customer_id');
        // To-do
        // if(!$customer_id){
        //     $customer_name=$this->request->getPost('customer_name');
        //     $customer_email=$this->request->getPost('customer_email');
        //     $customer_phone=$this->request->getPost('customer_phone');
        //     $customerModel = new CustomerModel();
        //     $customerModel->save([
        //         'name' => $customer_name,
        //         'email' => $customer_email,
        //         'phone' => $customer_phone,
        //     ]);
        //     $customer_id=$customerModel->getInsertID();
        // }
      //  print_r($arr);die;
        $ord=$order->save([
            'title' => '',
            'completion_date' => $this->request->getPost('completion_date'),
            'description' => $this->request->getPost('description'),
            'customer_id' => $this->request->getPost('customer_id'),
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 'Pending',
            'total_amount' => 0,
            'workflow_id' => 1,
            'material_id' => 0,
            'frame_id' => 0,
            'size_id' => 0,
            'type_id' => 0,
            'assigned_to' => session()->get('user_id'),
        ]);  
        $id=$order->getInsertID();  
        $order->update($id, [
            'serial' => '1111'.$id,
        ]);
        $quantity = $this->request->getPost('quantity');
        $frame_id = $this->request->getPost('frame_id');
        $size_id = $this->request->getPost('size_id');
        $type_id = $this->request->getPost('type_id');
        $material_id = $this->request->getPost('material_id');
        foreach ($quantity as $index => $item) {
            if (empty($quantity[$index]) || $quantity[$index] <= 0) {
                continue; // Skip empty quantity
            }
            $orderItemsModel->save([
            'order_id' => $id,
            'status' => 'Pending',
            'amount_item' => 0,
            'workflow_id' => 1,
            'material_id' => $material_id[$index],
            'frame_id' => $frame_id[$index],
            'size_id' => $size_id[$index],
            'type_id' => $type_id[$index],
            'title' => '',
            'quantity' => $quantity[$index],
            'assigned_to' => session()->get('user_id'),
            ]);
        }
        return redirect()->to('/orders/view/'.$id)->with('success', 'Order created successfully!');
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

    $orderItemsModel = new OrderItemsModel();

    $orderDetails['customer'] = $customerModel->find($orderDetails['customer_id']);
    //$orderDetails['assigned'] = $userModel->find($orderDetails['assigned_to']);
    // $orderDetails['workflow'] = $workflowModel->find($orderDetails['workflow_id']);
    // $orderDetails['material'] = $materialModel->find($orderDetails['material_id']);
    // $orderDetails['frame'] = $frameModel->find($orderDetails['frame_id']);
    // $orderDetails['size'] = $sizeModel->find($orderDetails['size_id']);
    // $orderDetails['type'] = $typeModel->find($orderDetails['type_id']);
    $is_agennt=true;
    // To-do
    $priceshow=false;
    $orderDetails['items'] = $orderItemsModel
        ->select('order_items.*, materials.material as material_name,
         types.title as type_name, 
         frames.name as frame_name, 
         sizes.title as size_name,
         materials.agent_price as material_agent_price,
         materials.price as material_customer_price,
         types.price as type_customer_price,
         types.agent_price as type_agent_price,
         frames.price as frame_customer_price,
         frames.agent_price as frame_agent_price,
         sizes.price as sizes_customer_price,
         sizes.agent_price as sizes_agent_price,
         ')
        ->join('materials', 'materials.id = order_items.material_id', 'left')
        ->join('types', 'types.id = order_items.type_id', 'left')
        ->join('frames', 'frames.id = order_items.frame_id', 'left')
        ->join('sizes', 'sizes.id = order_items.size_id', 'left')
        ->where(['order_items.order_id' => $id])
        ->findAll();
    foreach ($orderDetails['items'] as &$item) {
        $item['price_material'] = $item['quantity'] * ($is_agennt?($item['agent_price'] ?? 0):($item['material_customer_price'] ?? 0)); 
        $item['price_type'] = $item['quantity'] * ($is_agennt ? ($item['type_agent_price'] ?? 0) : ($item['type_customer_price'] ?? 0));
        $item['price_frame'] = $item['quantity'] * ($is_agennt ? ($item['frame_agent_price'] ?? 0) : ($item['frame_customer_price'] ?? 0));
        $item['price_size'] = $item['quantity'] * ($is_agennt ? ($item['sizes_agent_price'] ?? 0) : ($item['sizes_customer_price'] ?? 0));
        $item['price_total'] = $item['price_material'] + $item['price_type'] + $item['price_frame'] + $item['price_size'];
    }
    unset($item); // Unset reference to avoid potential issues
    return view('pages/order/order-details', [
        'order' => $orderDetails,
        'workflowList' => $workflowModel->findAll(),
        'materialList' => $materialModel->findAll(),
        'frameList' => $frameModel->findAll(),
        'sizeList' => $sizeModel->findAll(),
        'typeList' => $typeModel->findAll(),
        'userList' => $userModel->findAll(),
        'priceshow'=>$priceshow,
    ]);
}
protected function getOrderDetails($order_id)
{
    $orderItemsModel = new OrderItemsModel();
    $userModel = new UserModel();
    $is_agennt=true;
    $total_amount=0;
    $orderDetails['items'] = $orderItemsModel
        ->select('order_items.*, materials.material as material_name,
         types.title as type_name, 
         frames.name as frame_name, 
         sizes.title as size_name,
         materials.agent_price as material_agent_price,
         materials.price as material_customer_price,
         types.price as type_customer_price,
         types.agent_price as type_agent_price,
         frames.price as frame_customer_price,
         frames.agent_price as frame_agent_price,
         sizes.price as sizes_customer_price,
         sizes.agent_price as sizes_agent_price,
         ')
        ->join('materials', 'materials.id = order_items.material_id', 'left')
        ->join('types', 'types.id = order_items.type_id', 'left')
        ->join('frames', 'frames.id = order_items.frame_id', 'left')
        ->join('sizes', 'sizes.id = order_items.size_id', 'left')
        ->where(['order_items.order_id' => $order_id])
        ->findAll();
    foreach ($orderDetails['items'] as &$item) {
        $item['price_material'] = $item['quantity'] * ($is_agennt?($item['agent_price'] ?? 0):($item['material_customer_price'] ?? 0)); 
        $item['price_type'] = $item['quantity'] * ($is_agennt ? ($item['type_agent_price'] ?? 0) : ($item['type_customer_price'] ?? 0));
        $item['price_frame'] = $item['quantity'] * ($is_agennt ? ($item['frame_agent_price'] ?? 0) : ($item['frame_customer_price'] ?? 0));
        $item['price_size'] = $item['quantity'] * ($is_agennt ? ($item['sizes_agent_price'] ?? 0) : ($item['sizes_customer_price'] ?? 0));
        $item['price_total'] = $item['price_material'] + $item['price_type'] + $item['price_frame'] + $item['price_size'];
        $total_amount += $item['price_total'];
    }
    unset($item); 
    $orderDetails['total_amount'] = $total_amount;
    return $orderDetails;
}
public function loadDetailsLineHTML($order_id)
    {
        $orderItemsModel = new OrderItemsModel();
        $userModel = new UserModel();
        $orderModel= new Order();
        $orderDetails = $this->getOrderDetails($order_id);
        // To-do
        $priceshow=false;
        $id= $this->request->getPost('id');
        
        if($id){
            $assigned_user= $this->request->getPost('assigned_user');
            $orderItemsModel->update($id, [
                'assigned_to' => $assigned_user,
            ]);
        }
        $orderDetails = $this->getOrderDetails($order_id);
        return view('pages/order/order-details-line', [
            'orderLine' => $orderDetails,
            'order' => $orderModel->find($order_id),
            'userList' => $userModel->findAll(),
            'priceshow'=>$priceshow,

        ]);
    }


    public function viewOrderold($id)
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
        return view('pages/order/order-details', [
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
    public function updateOrderItemStatus()
    {
        $orderItemsModel = new OrderItemsModel();
        $id = $this->request->getPost('orderId');
        $status = $this->request->getPost('status');
        $assignTo = $this->request->getPost('assignTo');
        $orderItemsModel->update($id, [
            'status' => $status,
            'assigned_to' => $assignTo,
        ]);
        return $this->response->setJSON(['status' => 'success']);
    }
}
