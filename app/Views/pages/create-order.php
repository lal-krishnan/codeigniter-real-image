<?=
    view('header/header');
?>
    <h1>Create a New Order</h1>
    <?= \Config\Services::validation()->listErrors(); ?>
    <div class=" -mx-4 bg-white p-6 rounded-lg shadow-md">
    <form id="createOrderForm" class="flex flex-wrap" method="POST" action="<?= site_url('orders/create') ?>">
        <!-- Customer Information -->

        <div class="w-full md:w-1/4 px-4 ">
            
                <?= csrf_field() ?>
                <section>
                    <h2 class="text-lg font-semibold mb-4">Customer Information</h2>
                    <p class="text-gray-600 mb-2">Please enter the customer's mobile number to fetch their details.</p>
                    <input type="hidden" name="customer_id" id="customer_id" value="<?= old('customer_id') ?>">
                    <div class="mb-4 items-center">
                        <label for="mobile_number" class="block text-gray-700 font-bold mb-2 mr-2">Mobile Number</label>
                        <div class="flex">
                            <input type="text" name="mobile_number" id="mobile_number" value="<?= old('mobile_number') ?>" required
                                class="flex-grow px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="button" onclick="checkCustomer()" 
                                class="ml-2 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Search
                            </button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="customer_name" class="block text-gray-700 font-bold mb-2">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" value="<?= old('customer_name') ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="whatsapp_number" class="block text-gray-700 font-bold mb-2">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number" value="<?= old('whatsapp_number') ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="email_address" class="block text-gray-700 font-bold mb-2">Email Address</label>
                        <input type="email" name="email_address" id="email_address" value="<?= old('email_address') ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                        <textarea name="address" id="address" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('address') ?></textarea>
                    </div>
                </section>
           
        </div>

        <!-- Order Information -->
        <div class="w-full md:w-1/4 px-4">
                <section>
                    <h2 class="text-lg font-semibold mb-4">Order Information</h2>
                    <p class="text-gray-600 mb-2">Please fill in the order details below.</p>
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Task Title</label>
                        <input type="text" name="title" id="title" value="<?= old('title') ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="completion_date" class="block text-gray-700 font-bold mb-2">Completion Date</label>
                        <input type="date" name="completion_date" id="completion_date" value="<?= old('completion_date') ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Price</label>
                        <input type="text" name="total_amount" id="total_amount" value="<?= old('total_amount') ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>                    
                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Assigned to : </label>
                    <select name="assigned_to" id="assigned_to" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select assignee</option>
                        <?php if(!empty($userList)){ foreach ($userList as $assigned): ?>
                            <option value="<?= $assigned['id'] ?>" <?= (old('assigned_to') == $assigned['id'] || (empty(old('assigned_to')) && $user['id']===$assigned['id'] ) ) ? 'selected' : '' ?>>
                                <?= $assigned['name'] ?>
                            </option>
                        <?php endforeach; } ?>
                    </select>
                    </div>
                </section>
           
        </div>
        <div class="w-full md:w-1/4 px-4">
        
        <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Select Workflow</label>
                    <select name="type_id" id="type_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Workflow</option>
                        <?php if(!empty($typeList)){ foreach ($typeList as $workflow): ?>
                            <option value="<?= $workflow['id'] ?>" <?= old('type_id') == $workflow['id'] ? 'selected' : '' ?>>
                                <?= $workflow['title'] ?>
                            </option>
                        <?php endforeach; } ?>
                    </select>
                    </div>
        <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Select Workflow</label>
                    <select name="workflow_id" id="workflow_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Workflow</option>
                        <?php if(!empty($workflows)){ foreach ($workflows as $workflow): ?>
                            <option value="<?= $workflow['id'] ?>" <?= old('workflow_id') == $workflow['id'] ? 'selected' : '' ?>>
                                <?= $workflow['title'] ?>
                            </option>
                        <?php endforeach; } ?>
                    </select>
                    </div>
                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Select Material</label>
                    <select name="material_id" id="material_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Material</option>
                        <?php if(!empty($materialList)){ foreach ($materialList as $workflow): ?>
                            <option value="<?= $workflow['id'] ?>" <?= old('material_id') == $workflow['id'] ? 'selected' : '' ?>>
                                <?= $workflow['material'] ?>
                            </option>
                        <?php endforeach; } ?>
                    </select>
                    </div>
                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Select Frame</label>
                    <select name="frame_id" id="frame_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Frame</option>
                        <?php if(!empty($frameList)){ foreach ($frameList as $frame): ?>
                            <option value="<?= $frame['id'] ?>" <?= old('frame_id') == $frame['id'] ? 'selected' : '' ?>>
                                <?= $frame['name'] ?>
                            </option>
                        <?php endforeach; } ?>
                    </select>
                    </div>

                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-bold mb-2">Select Size</label>
                    <select name="size_id" id="size_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Size</option>
                        <?php if(!empty($sizeList)){ foreach ($sizeList as $frame): ?>
                            <option value="<?= $frame['id'] ?>" <?= old('size_id') == $frame['id'] ? 'selected' : '' ?>>
                                <?= $frame['title'] ?>
                            </option>
                        <?php endforeach; } ?>
                    </select>
                    </div>
                    
                    
                    
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('description') ?></textarea>
                    </div>
                    <div>
                        <button type="submit" id="submitOrderForm"
                            class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Create Task
                        </button>
                    </div>
        </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // $('#submitOrderForm').click(function() {
            //     var formData = $('#createOrderForm').serialize();
            //     $.ajax({
            //         url: '<?= site_url('create-order') ?>',
            //         type: 'POST',
            //         data: formData,
            //         success: function(response) {
            //             alert('Order created successfully!');
            //             $('#createOrderForm')[0].reset();
            //         },
            //         error: function(xhr, status, error) {
            //             alert('An error occurred: ' + xhr.responseText);
            //         }
            //     });
            // });
        });
    function  checkCustomer(){
                var mobileNumber = $('#mobile_number').val();
                if (mobileNumber) {
                    $.ajax({
                        url: '<?= site_url('customers/get-user-by-mobile') ?>',
                        type: 'POST',
                        data: {
                            mobile_number: mobileNumber,
                            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                        },
                        success: function(response) {
                            if (response) {
                                console.log(response);
                                var customer = (response);
                                $('#customer_name').val(customer.name).attr('readonly', true);
                                $('#mobile_number').val(customer.phone);    
                                $('#whatsapp_number').val(customer.whatsapp).attr('readonly', true);   
                                $('#email_address').val(customer.email).attr('readonly', true); 
                                $('#address').val(customer.address).attr('readonly', true); 
                                $('#customer_id').val(customer.id); 
                                
                            } else {
                                alert('No customer found with this mobile number.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while fetching customer data.');
                        }
                    });
                }
            }
           
</script>
    <?php
   // $this->load->view('footer/footer');
?>