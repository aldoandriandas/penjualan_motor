@include('layouts.header')

<body class="flex flex-col min-h-screen">


    {{-- Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
