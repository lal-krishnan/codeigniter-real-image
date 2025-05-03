<?= view('header/header'); ?>
<div class="container mx-auto p-4">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">My Tasks</h1>
        <?php if (!empty($orderItems) && is_array($orderItems)) : ?>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                                                        
                            <th class="border border-gray-300 px-4 py-2 text-left">Material Name</th>                           
                            <th class="border border-gray-300 px-4 py-2 text-left">Frame</th>                           
                            <th class="border border-gray-300 px-4 py-2 text-left">Order Serial</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Order Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Customer Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Order Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>    
                            <th class="border border-gray-300 px-4 py-2 text-left">Action</th>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $index => $item) : ?>
                            <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= $item['material_name']." ".$item['type_name']." ".$item['size_name']; ?></td>                                
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['frame_name']); ?></td>                                
                                <td class="border border-gray-300 px-4 py-2"><a class="text-blue-500 font-bold" href="<?= site_url('orders/view/'.$item['order_id']) ?>"> <?= htmlspecialchars($item['order_serial']); ?></a></td>                                
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars(date('D-M-Y',strtotime($item['order_created_at']))); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['customer_name']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['status']); ?></td>
                                <td class="border border-gray-300 x-4 py-2"><?= htmlspecialchars($item['quantity']); ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <button  type="button" onClick="openModal(<?= $item['id']?>,'<?= $item['status']?>')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-gray-500">No task found.</p>
            <?php endif; /* ?>
        <div class="grid grid-cols-3     gap-4">
           
          
            <!-- To Do Section -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">To Do</h2>
                <ul class="space-y-2">
                    <?php if(!empty($pendingOrders)){ foreach ($pendingOrders as $order): ?>
                        <li class="bg-white p-4 rounded shadow flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg"><?= htmlspecialchars($order['serial']); ?></span>
                                <a href="/orders/view/<?= $order['id']; ?>" class="text-blue-500 hover:underline">View</a>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']); ?></p>
                                <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['customer_name']); ?></p>
                            </div>
                        </li>
                    <?php endforeach; }else{ echo "No order found"; } ?>
                </ul>
            </div>

            <!-- In Progress Section -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">In Progress</h2>
                <ul class="space-y-2">
                    <?php if(!empty($inProgressOrders)){ foreach ($inProgressOrders as $order): ?>
                        <li class="bg-white p-4 rounded shadow flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg"><?= htmlspecialchars($order['serial']); ?></span>
                                <a href="/orders/view/<?= $order['id']; ?>" class="text-blue-500 hover:underline">View</a>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']); ?></p>
                                <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['customer_name']); ?></p>
                            </div>
                        </li>
                        <?php endforeach; }else{ echo "No order found"; } ?>
                </ul>
            </div>

            <!-- Done Section -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Done</h2>
                <ul class="space-y-2">
                    <?php if(!empty($completedOrders)){ foreach ($completedOrders as $order): ?>
                        <li class="bg-white p-4 rounded shadow flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg"><?= htmlspecialchars($order['serial']); ?></span>
                                <a href="/orders/view/<?= $order['id']; ?>" class="text-blue-500 hover:underline">View</a>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']); ?></p>
                                <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['customer_name']); ?></p>
                            </div>
                        </li>
                        <?php endforeach; }else{ echo "No order found"; } ?>
                </ul>
            </div>
        </div>
        <?php */?>
    </div>
</div>
<!-- Modal -->
<div id="updateModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="p-4 border-b">
            <h2 class="text-lg font-bold">Update Order Status</h2>
        </div>
        <div class="p-4">
            <label for="orderStatus" class="block text-sm font-medium text-gray-700">Select Status</label>
            <select style="padding:10px;border:1px solid;" id="orderStatus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">                
                <option  value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option  value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="p-4">
            <label for="orderStatus" class="block text-sm font-medium text-gray-700">Assign</label>
            <select style="padding:10px;border:1px solid;" id="assignTo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">                
                <option value="">Select User</option>
                <?php foreach ($userList as $user) : ?>
                    <option value="<?= htmlspecialchars($user['id']) ?>" <?=@$item['assigned_to']==$user['id']
                        ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['name']) ?>
                    </option>
                <?php endforeach; ?>
        </select>
        </div>
        <div class="flex justify-end p-4 border-t">
            <button id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Close</button>
            <button id="submitModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('updateModal');
    const closeModal = document.getElementById('closeModal');
    const submitModal = document.getElementById('submitModal');
                    
    function openModal(orderId,curStatus) {
        modal.dataset.orderId = orderId;
        modal.dataset.curStatus = curStatus;
        modal.classList.remove('hidden');
    }

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    submitModal.addEventListener('click', () => {
        const orderId = modal.dataset.orderId;
        const status = document.getElementById('orderStatus').value;
        const assignTo = document.getElementById('assignTo').value;
        updateOrderStatus(orderId, status,assignTo);
        modal.classList.add('hidden');
    });
</script>
<script>
    function updateOrderStatus(orderId, status,assignTo) {
        // Make an AJAX request to update the order status
        $.ajax({
            url: '/order-item/updateStatus',
            type: 'POST',
           dataType: 'json',
            data: { orderId: orderId, status: status,assignTo:assignTo },
            success: function(data) {
                console.log('Response:', data.status);
            if (data.status) {
                // Update the UI or refresh the page
                location.reload();
            } else {
                alert('Failed to update order status.');
            }
            },
            error: function(xhr, status, error) {
            console.error('Error:', error);
            }
        });
    }
</script>