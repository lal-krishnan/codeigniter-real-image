<style>
    .text-right{
        text-align: right;
    }
    </style>
            <div class="mb-4 flex flex-row">
                <p class="inputheight mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <?= htmlspecialchars($order['customer']['name']) ?>
</p>
                <p>
                    <?= htmlspecialchars($order['customer']['email']) ?>
</p>
                <p class="inputheight mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <?= htmlspecialchars($order['customer']['phone']) ?>
</p>
            </div>
            <h2 class="text-xl font-semibold mb-4">Order Information</h2>
            <table class="table-auto w-full border-collapse border border-gray-300" with="100%">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">Item Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Price Material</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Price Frame</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Price Type</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Price Size</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Total</th>
                    </tr>
                </thead>
                <tbody id="order_items">
                    <?php if (!empty($orderLine['items'])) : ?>
                    <?php foreach ($orderLine['items'] as $item) : ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= ($item['material_name'])." ".($item['type_name'])." ".($item['size_name'])." ".($item['frame_name']) ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= htmlspecialchars($item['quantity']) ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= htmlspecialchars($item['price_material']) ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= htmlspecialchars($item['price_frame']) ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= htmlspecialchars($item['price_type']) ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= htmlspecialchars($item['price_size']) ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?= htmlspecialchars($item['price_total']) ?>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Sub total:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label><?= number_format($orderLine['total_amount']) ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Advance:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label><?= number_format($order['advance']) ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Discount:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label><?= number_format($order['discount']) ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Sub total less:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label id="sub_total_less"></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">SG ST:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label id="sgst"></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">CG ST:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label id="cgst"></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Total:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            <label id="total_amount" style="font-weight:bold;font-size:20px"></label>
                        </td>
                    </tr>
                </tbody>
            </table>
