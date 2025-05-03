<?=
    view('header/header');
?>
<h1>Create a New Order</h1>
<?= \Config\Services::validation()->listErrors(); ?>
<div class=" -mx-4 bg-white p-6 rounded-lg shadow-md">
    <form id="createOrderForm" method="POST" action="<?= site_url('orders/line-create') ?>">
    <section>
        <h2 class="text-lg font-semibold mb-4">Customer Information</h2>
        <p class="text-gray-600 mb-2">Please enter the customer's mobile number to fetch their details.</p>
        <input type="hidden" name="customer_id" id="customer_id" value="<?= old('customer_id') ?>">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-3 flex items-center">
                <label for="mobile_number" class="block text-gray-700 font-bold mb-2 mr-2">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number" value="<?= old('mobile_number') ?>" required
                    class="flex-grow px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" onclick="checkCustomer()" 
                    class="ml-2 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Search
                </button>
            </div>
            <div>
                <label for="customer_name" class="block text-gray-700 font-bold mb-2">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" value="<?= old('customer_name') ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="whatsapp_number" class="block text-gray-700 font-bold mb-2">WhatsApp Number</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" value="<?= old('whatsapp_number') ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="email_address" class="block text-gray-700 font-bold mb-2">Email Address</label>
                <input type="email" name="email_address" id="email_address" value="<?= old('email_address') ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="col-span-3">
                <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                <textarea name="address" id="address" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('address') ?></textarea>
            </div>
        </div>
    </section>
        <input type="text" name="mode" id="mode" value="<?= $mode ?>">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left border border-gray-300">Title</th>
                <th class="px-4 py-2 text-left border border-gray-300">Total Amount</th>
                <th class="px-4 py-2 text-left border border-gray-300">Type</th>
                <th class="px-4 py-2 text-left border border-gray-300">Material</th>
                <th class="px-4 py-2 text-left border border-gray-300">Frame</th>
                <th class="px-4 py-2 text-left border border-gray-300">Size</th>
                <th class="px-4 py-2 text-left border border-gray-300">Quantity</th>

                </tr>
            <tbody id="lineItemsContainer">
                <?php if($mode =='create'): for($i=0;$i<5;$i++): ?>
                <?= view('/pages/order/line') ?>
                <?php endfor; endif; ?>
            </tbody>
        </table>
        <div class="mt-4 flex justify-end">
            <div class="flex items-center mr-4">
                <button type="button" id="loadMoreLine" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Load More</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Create Order</button>   
            </div>
        </div>
    </form>
</div>


<script>
        $(document).ready(function() {
            $('#loadMoreLine').click(function() {           
                alert('Load more line items');    
                $.ajax({
                    url: '<?= site_url('order/ajax/line-list') ?>',
                    type: 'get',
                    success: function(response) {
                        $('#lineItemsContainer').append(response);
                        alert('Load more line items222');    
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + xhr.responseText);
                        alert('Load more line items sss'); 
                    }
                });
            });
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