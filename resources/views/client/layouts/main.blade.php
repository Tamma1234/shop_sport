<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.layouts.partials.css')
    <title>@yield('title', 'Trang khách hàng')</title>
</head>
<body>
    @include('client.components.topbar')
    @include('client.components.header')
    <main>
        @yield('content')
    </main>
    @include('client.components.footer')
    @include('client.layouts.partials.scripts')
</body>
</html>