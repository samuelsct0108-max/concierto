<!doctype html>
<html>
<head>
    @include('dist.partials.heads')
    @stack('head_code')
    <title>Concert - @yield('title_page')</title>
</head>
<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <div>
        @include('dist.partials.left-sidebar')
        <div class="page-container">
            @include('dist.partials.header-nav-bar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    @yield('content')
                </div>
            </main>
            @include('dist.partials.footer')
        </div>
    </div>
    @include('dist.partials.scripts')
    @stack('scripts_code')
</body>
</html>
