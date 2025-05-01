<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <?php if (isset($validation)): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <a href="<?= base_url('auth/forgot-password') ?>" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Login</button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-600">
            Don't have an account? <a href="<?= base_url('auth/register') ?>" class="text-indigo-600 hover:text-indigo-500">Sign up</a>
        </p>
    </div>
</body>
</html>