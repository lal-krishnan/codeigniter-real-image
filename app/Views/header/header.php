<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'CodeIgniter Application' ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .inputheight{
            height: 40px;
            
        }        </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">My App</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="<?= base_url('/') ?>" class="hover:underline">Home</a></li>
                    <li><a href="<?= base_url('/orders') ?>" class="hover:underline">Orders</a></li>
                    <li><a href="<?= base_url('/contact') ?>" class="hover:underline">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mx-auto mt-6">