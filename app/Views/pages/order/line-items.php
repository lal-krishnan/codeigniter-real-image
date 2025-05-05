<?=
    view('header/header');
?>
<h1 class="text-xl font-semibold mb-4">Create a New Order</h1>
<?= \Config\Services::validation()->listErrors(); ?>
<div class=" -mx-4 bg-white p-6 rounded-lg shadow-md">
    <form id="createOrderForm" method="POST" action="<?= site_url('orders/line-create') ?>">
    <?=
    view('pages/customer/customer-create');
?>
    <section id="lineItemsSection" class="mt-6 hidden">
        <h2 class="text-lg font-semibold mb-4">Line Items</h2>
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
                <button type="button" id="loadMoreLine" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-10">Load More</button>
                <button type="submit"  class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-white-600">Create Order</button>   
            </div>
        </div>
    </section>
    </form>
</div>


<script>
        $(document).ready(function() {
            $('#loadMoreLine').click(function() {    
                $.ajax({
                    url: '<?= site_url('order/ajax/line-list') ?>',
                    type: 'get',
                    success: function(response) {
                        $('#lineItemsContainer').append(response);
                           
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + xhr.responseText);
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
                                if(response.error){
                                    $('#customerBtn').show();
                                }else{
                                $('#customer_name').val(customer.name).attr('readonly', true);
                                $('#mobile_number').val(customer.phone);    
                                $('#whatsapp_number').val(customer.whatsapp).attr('readonly', true);   
                                $('#email_address').val(customer.email).attr('readonly', true); 
                                $('#address').val(customer.address).attr('readonly', true); 
                                $('#customer_id').val(customer.id); 
                                $('#lineItemsSection').removeClass('hidden');
                                $('#lineItemsSection').show();
                                $(".title-class:first").focus();
                                $('#customerBtn').hide();
                                }
                            } else {
                                $('#customerBtn').show();
                                alert('No customer found with this mobile number.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while fetching customer data.');
                        }
                    });
                }
            }
 function createCustomer(){
    var customerData = {
        name: $('#customer_name').val(),
        phone: $('#mobile_number').val(),
        whatsapp: $('#whatsapp_number').val(),
        email: $('#email_address').val(),
        address: $('#address').val(),
        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
    };

    $.ajax({
        url: '<?= site_url('customers/create') ?>',
        type: 'POST',
        data: customerData,
        success: function(response) {
            if (response.success) {
                alert('Customer created successfully.');
                $('#customer_id').val(response.customer_id);
                $('#mobile_number').val(response.mobile);

                $('#lineItemsSection').removeClass('hidden');
                $('#lineItemsSection').show();
                $(".title-class:first").focus();
                $('#customerBtn').hide();
                checkCustomer();
            } else {
                alert('Failed to create customer: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + xhr.responseText);
        }
    });
 }          
</script>