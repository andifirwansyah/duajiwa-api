<!DOCTYPE html>
<html lang="en" class="light">
<head>
    @include('admin._layouts.inc._head')
    @stack('css')
</head>
<body class="py-5 md:py-0">
    @include('admin._layouts.parts._mobile')
    @include('admin._layouts.parts._navbar')
    <div class="flex overflow-hidden">
        @include('admin._layouts.parts._sidebar')
        <div class="content">
            @yield('content')
        </div>
    </div>
    @include('admin._layouts.inc._script')
    @stack('js')
</body>
</html>
