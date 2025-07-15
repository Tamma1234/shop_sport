<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Soccer Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .text-muted-foreground {
            color: #6b7280;
        }
        .sidebar-item:hover {
            background-color: #f3f4f6;
        }
        .sidebar-item.active {
            background-color: #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            @include('components.header')

            <!-- Dashboard Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts') <!-- 💡 THÊM DÒNG NÀY TRƯỚC </body> -->
</body>
</html> 