<?=
    view('header/header');
?>
<h1 class="text-2xl font-bold mb-4">Order : <span class="text-blue-500">
        <?= htmlspecialchars($order['serial']) ?>
    </span> </h1>
<main>
    <?php /*
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
    </section> */?>
    <section class="flex flex-row gap-4 flex-wrap ">
        <div class="bg-white p-6 flex-1 rounded-lg shadow-md ">
            <?php if ($order['status'] === 'Completed') : ?>
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                <strong>Success:</strong> The order has been delivered.
            </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 gap-4">
                <div class="mb-4 flex flex-row">
                    <input type="text" id="customer_name" name="customer_name"
                        value="<?= htmlspecialchars($order['customer']['name']) ?>"
                        class="inputheight mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                    <input type="text" id="customer_email" name="customer_email"
                        value="<?= htmlspecialchars($order['customer']['email']) ?>"
                        class="inputheight mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                    <input type="text" id="customer_phone" name="customer_phone"
                        value="<?= htmlspecialchars($order['customer']['phone']) ?>"
                        class="inputheight mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                  

                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">Item Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                            <?php if($priceshow): ?>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price Material</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price Frame</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price Type</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price Size</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Total</th>
                            <?php endif ?>
                            <?php if ($order['status'] != 'Completed') : ?>
                            <th class="border border-gray-300 px-4 py-2 text-left">Assign</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="order_items">
                       
                    </tbody>
                </table>

            </div>

            <div class="text-right">

                <?php /* if(!empty($workflowList[$order['workflow_id']])){  ?>
                <!-- <?php //if(count($workflowList) < $order['workflow_id']) { ?> -->
                <form action="<?= site_url('orders/update-workflow/'.$order['id']) ?>" method="post">
                    <label><strong> Assigned to : </strong></label>
                    <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                    <select name="assigned_user" id="assigned_user"
                        class="inputheight mt-1 mr-10  focus:border-blue-500">
                        <option value="">Select User</option>
                        <?php foreach ($userList as $user) : ?>
                        <option value="<?= htmlspecialchars($user['id']) ?>" <?=@$order['assigned']['id']==$user['id']
                            ? 'selected' : '' ?>>
                            <?= htmlspecialchars($user['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="status" value="In progress" />
                    <button href="<?= site_url(" /orders/update-workflow/".$order['id']) ?>" class="inputheight
                        bg-blue-500 mt-4 text-white
                        px-4 py-2 rounded-md hover:bg-blue-600 inline-block" >Move To
                        <?php echo $workflowList[$order['workflow_id']]['title'] ?>
                    </button>
                    <input type="hidden" name="workflow_id" class="inputheight"
                        value="<?= htmlspecialchars($workflowList[$order['workflow_id']]['id']) ?>" />

                </form>
                <?php } */
                if($order['status']!='Completed'){ ?>
                <form action="<?= site_url('orders/update-workflow/'.$order['id']) ?>" method="post">

                    <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                    <input type="hidden" name="assigned_user" value="<?= htmlspecialchars($order['assigned_to']) ?>">
                    <input type="hidden" name="status" value="Completed" />
                    <button href="<?= site_url(" /orders/update-workflow/".$order['id']) ?>" class="bg-green-500 mt-4
                        text-white
                        px-4 py-2 rounded-md hover:bg-blue-600 inline-block" >Complete Order and Move To Billing
                    </button>
                    <input type="hidden" name="workflow_id" value="<?= $order['workflow_id'] ?>" />

                </form>
                <?php   } ?>
            </div>
        </div>

    </section>
    <section class="text-center mt-4">
     
            <?php if ($order['status'] === 'Completed') : ?>
                <!-- <button onClick="printInvoice()" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Print Invoice</button> -->
            <iframe id="printFrame" src="<?= site_url('order/invoicePdf/'.$order['id']) ?>" style="width:100%;border:1px solid;height:600px" name="printFrame" ></iframe>
            
            <?php endif        ?>

               
                </section>
</main>
<script>
    function printInvoice() {
        $.ajax({
            url: "<?= site_url('order/ajax/save-discount-price/'.$order['id']) ?>",
            type: "POST",
            dataType: "json",
            data: {
                discount: document.getElementById("discount").value,
                advance: document.getElementById("advance").value,
                total_amount: document.getElementById("total_amount").value
            },
            success: function (response) {
                if (response.success) {
                    alert("Discount and price information saved successfully.");
                } else {
                    alert("Failed to save discount and price information.");
                }
                window.print();
            },
            error: function (xhr, status, error) {
                console.error("Error saving discount and price information:", error);
                alert("An error occurred while saving the data.");
            }
        });
     
    }
    function changeAssign(id) {
        var selectedValue = document.getElementById("assigned_user"+id).value;
        var assignBtn = document.getElementById("assign_btn_" + id);


        if (selectedValue) {
            assignBtn.disabled = false;
        } else {
            assignBtn.disabled = true;
        }
       
    }
    function assignOrder(id) {
        var selectedValue = document.getElementById("assigned_user"+id).value;
        var assignBtn = document.getElementById("assign_btn_" + id);
        loadLineHTML(id, selectedValue);
    }
    function loadLineHTML(id, selectedValue = null) {
        $.ajax({
            url: "<?= site_url('order/ajax/detatils-line-list/'.$order['id']) ?>",
            type: "POST",
            dataType: "html",
            data: {
                id:id,
                assigned_user: selectedValue
            },
            success: function (response) {
                if(selectedValue)
            alert("Order Assigned Successfully");
                $("#order_items").html(response);
                calcutateSubTotal() 
            },
            error: function (xhr, status, error) {
                console.error("Error loading line items:", error);
            }
        });
    }
    loadLineHTML(0);

    function calcutateSubTotal() {
        var totalAmount = parseFloat(document.getElementById("sub_total").value) || 0;
        var advance = parseFloat(document.getElementById("advance").value) || 0;
        var discount = parseFloat(document.getElementById("discount").value) || 0;

        var subTotalLess = totalAmount - advance - discount;
        document.getElementById("sub_total_less").value = subTotalLess.toFixed(2);
       
        var sgst = (subTotalLess * 9) / 100;
        document.getElementById("sgst").value = sgst.toFixed(2);
        var cgst = (subTotalLess * 9) / 100;
        document.getElementById("cgst").value = cgst.toFixed(2);
        var total = subTotalLess + sgst + cgst;
        document.getElementById("total_amount").value = total.toFixed(2);
    }

    </script>