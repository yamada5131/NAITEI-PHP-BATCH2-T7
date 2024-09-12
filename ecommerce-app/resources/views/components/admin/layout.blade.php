<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    @include('components.admin.navbar-dashboard')

    <main>
        <div class="sm:ml-64">
            <div class="mt-14 bg-white dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>

    </main>


    <script></script>
</body>

</html>
