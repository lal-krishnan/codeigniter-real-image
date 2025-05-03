<?php if (!empty($orderLine['items'])) : ?>
                        <?php foreach ($orderLine['items'] as $item) : ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= ($item['material_name'])." ".($item['type_name'])." ".($item['size_name'])." ".($item['frame_name']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['quantity']) ?></td>                            
                            <?php if($priceshow): ?>
                                  <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['price_material']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['price_frame']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['price_type']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['price_size']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['price_total']) ?></td>
                            <?php endif ?>
                            <?php if ($order['status'] != 'Completed') : ?>
                            <td class="border border-gray-300 px-4 py-2">
                            <select name="assigned_user<?= $item['id'] ?>" onchange="changeAssign(<?= $item['id'] ?>)" id="assigned_user<?= $item['id'] ?>"
                            class="inputheight mt-1 mr-10  focus:border-blue-500">
                            <option value="">Select User</option>
                            <?php foreach ($userList as $user) : ?>
                            <option value="<?= htmlspecialchars($user['id']) ?>" <?=@$item['assigned_to']==$user['id']
                                ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['name']) ?>
                            </option>
                        <?php endforeach;
                     ?>
                    </select>
                    <button class="bg-blue-600 text-white font-semibold px-1 py-1 rounded 
         hover:bg-blue-700 
         disabled:bg-gray-400 disabled:cursor-not-allowed disabled:opacity-50"
          disabled id="assign_btn_<?= $item['id'] ?>"
          onclick="assignOrder(<?= $item['id'] ?>)"
          >Assign</button>
                    </button>
                            </td> <?php endif; ?>
                        </tr>
                        <?php endforeach; endif; ?>

                        <?php if($priceshow): ?>
<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Sub total:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold">
      <input type="number" value="<?= number_format($orderLine['total_amount']) ?>" id="sub_total" readonly />
    </td>
</tr>
<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Advance:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold">
        <input type="number" value="<?= number_format($order['advance']) ?>"  id="advance" readonly />
    </td>
</tr>
<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Discount:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold">        
        <input type="number" value="<?= number_format($order['discount']) ?>"  id="discount" onKeyUp="calcutateSubTotal()"   />
    </td>
</tr>
<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Sub total less:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold" >        
        <input type="number"   id="sub_total_less"  readonly />
        
        
    </td>
</tr>


<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">SG ST:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold" >
    <input type="number"   id="sgst"  readonly />
    </td>
</tr>
<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">CG ST:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold" >
            <input type="number"   id="cgst"  readonly />
    </td>
</tr>

<tr>
    <td colspan="6" class="border border-gray-300 px-4 py-2 text-right font-bold">Total:</td>
    <td class="border border-gray-300 px-4 py-2 font-bold"   >
    <input type="number"  id="total_amount" class="" style="font-weight:bold;font-size:20px"  readonly />
    </td>
</tr>

<?php endif; ?>