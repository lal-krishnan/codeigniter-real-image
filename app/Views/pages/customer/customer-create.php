<section >
        <input type="hidden" name="customer_id" id="customer_id" value="<?= old('customer_id') ?>">
        <div class="grid grid-cols-4 gap-4">
            <div class=" items-center">
                <label for="mobile_number" class="block text-gray-700 font-bold mb-2 mr-2">Mobile Number</label>
                <input type="text" onblur="checkCustomer()" name="mobile_number" id="mobile_number" value="<?= old('mobile_number') ?>" required
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
            <div class="">
                <label for="gst" class="block text-gray-700 font-bold mb-2">GST</label>
                <input name="gst" id="gst" rows="3" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('address') ?></textarea>
            </div>
            <div class="">
                <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                <textarea name="address" id="address" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('address') ?></textarea>
            </div>
            <div >
                <button 
                    type="button" 
                    id="customerBtn"
                    onclick="createCustomer()"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-10">Create customer</button>
            </div>
        </div>
    </section>