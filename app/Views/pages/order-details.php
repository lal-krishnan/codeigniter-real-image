<?=
    view('header/header');
?>
<h1 class="text-2xl font-bold mb-4">Order : <span class="text-blue-500">
        <?= htmlspecialchars($order['serial']) ?>
    </span> </h1>
<main>
    <section>
        <div class="flex items-center justify-between mb-6">
            <?php if (isset($workflowList)) { ?>
            <?php foreach ($workflowList as $index => $workflow) : ?>
            <?php if ($index > 0) : ?>
            <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
            <?php endif; ?>
            <div class="flex items-center"><!-- bg-blue-500 -->
                <div
                    class="w-8 h-8 flex items-center justify-center <?php echo ($order['workflow_id']!=$workflow['id'])?'bg-gray-300':'bg-green-500' ?> text-white rounded-full">
                    <?= $index+1 ?>
                </div>
                <span class="ml-2 text-sm font-medium">
                    <?= htmlspecialchars($workflow['title']) ?>
                </span>
            </div>
            <?php endforeach;    ?>
            <?php } ?>
        </div>
    </section>
    <section>
        <div class="bg-white p-6 rounded-lg shadow-md ">
                <?php if ($order['status'] === 'Completed') : ?>
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        <strong>Success:</strong> The order has been delivered.
                    </div>
                <?php endif; ?>
            <div class="grid grid-cols-1 gap-4">
                <div class="mb-4 flex flex-row">
                    <input type="text" id="customer_name" name="customer_name"
                        value="<?= htmlspecialchars($order['customer']['name']) ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                    <input type="text" id="customer_email" name="customer_email"
                        value="<?= htmlspecialchars($order['customer']['email']) ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                    <input type="text" id="customer_phone" name="customer_phone"
                        value="<?= htmlspecialchars($order['customer']['phone']) ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                    <div>
                        <?= htmlspecialchars(@$order['assigned']['name']) ?>
                    </div>

                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label for="order_id" class="block text-sm font-medium text-gray-700">Order ID</label>
                        <input type="text" id="order_id" name="order_id" value="<?= htmlspecialchars($order['id']) ?>"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            readonly>
                    </div>
                </div>

            </div>
            
            <div class="text-right">
                
            <?php if(!empty($workflowList[$order['workflow_id']])){  ?>
                <!-- <?php //if(count($workflowList) < $order['workflow_id']) { ?> -->
                <form action="<?= site_url('orders/update-workflow/'.$order['id']) ?>" method="post">
                <label><strong> Assigned to :  </strong></label>
                <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                <select name="assigned_user" id="assigned_user" class="mt-1 mr-10  focus:border-blue-500">
                    <option value="">Select User</option>
                    <?php foreach ($userList as $user) : ?>
                    <option value="<?= htmlspecialchars($user['id']) ?>" <?=@$order['assigned']['id']==$user['id']
                        ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="status" value="In progress"/>
                <button href="<?= site_url(" /orders/update-workflow/".$order['id']) ?>" class="bg-blue-500 mt-4 text-white
                    px-4 py-2 rounded-md hover:bg-blue-600 inline-block" >Move To
                    <?php echo $workflowList[$order['workflow_id']]['title'] ?>
                </button>
                <input type="hidden" name="workflow_id" value="<?= htmlspecialchars($workflowList[$order['workflow_id']]['id']) ?>"/>
              
                </form><?php }elseif($order['status']!='Completed'){ ?>
                    <form action="<?= site_url('orders/update-workflow/'.$order['id']) ?>" method="post">
             
                <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                    <input type="hidden" name="assigned_user" value="<?= htmlspecialchars($order['assigned_to']) ?>">
                      <input type="hidden" name="status" value="Completed"/>
                <button href="<?= site_url(" /orders/update-workflow/".$order['id']) ?>" class="bg-green-500 mt-4 text-white
                    px-4 py-2 rounded-md hover:bg-blue-600 inline-block" >Finish Order
                </button>
                <input type="hidden" name="workflow_id" value="<?= $order['workflow_id'] ?>"/>
              
                </form>
<?php   } ?>
            </div>  
        </div>


    </section>
</main>