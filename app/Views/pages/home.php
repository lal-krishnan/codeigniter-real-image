<?= view('header/header'); ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Welcome to the Kanban Board</h1>
    <div class="container mx-auto p-4">
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
    </div>
</div>