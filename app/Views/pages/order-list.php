<?=
    view('header/header');
?>
<?php
// Check if orders are available
if (!empty($orders) && is_array($orders)) : ?>
    <h1 class="text-2xl font-bold mb-4">Order List</h1>
    <a href="<?= site_url('orders/create') ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Create New Order</a>
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Order ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Customer Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Order Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $index => $order) : ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2"><?= $index + 1; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= esc($order['id']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"></td>
                        <td class="border border-gray-300 px-4 py-2"><?= esc($order['order_date']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= esc($order['status']); ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="<?= site_url('orders/view/' . $order['id']); ?>" class="text-blue-500 hover:underline">View</a> |
                            <a href="<?= site_url('orders/edit/' . $order['id']); ?>" class="text-green-500 hover:underline">Edit</a> |
                            <a href="<?= site_url('orders/delete/' . $order['id']); ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <p class="text-gray-500">No orders found.</p>
<?php endif; ?>
