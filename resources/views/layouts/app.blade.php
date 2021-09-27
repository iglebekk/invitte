<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"   integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="   crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    @yield('head')
</head>
<body class="bg-dark text-light">
    <main>
        <div class="container py-4">
            <header class="pb-2 mb-4 border-bottom">
                <div class="row">
                    <div class="col">
                        <a href="/" class="d-flex align-items-center text-light text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="me-2" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                            </svg>
                            <span class="fs-4">{{ config('app.name') }}</span>
                        </a>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <a href="{{ route('logout') }}" class="text-decoration-none link-light pe-3">
                            <span class="fs-6">Logg ut</span>
                        </a>
                    </div>
                </div>
            </header>

            @yield('content')

            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2021 - Baked by <a href="http://www.iglebekk.no" class="text-decoration-none text-muted">Iglebekk&Co</a>
            </footer>
        </div>
    </main>

 @yield('bottom')
</body>

</html>
