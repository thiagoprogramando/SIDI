<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>@yield('title') - {{ env('APP_NAME') }}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <link href="{{ asset('template/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('template/img/favicon.png') }}" rel="apple-touch-icon">

        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('template/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('template/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('template/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('template/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

        <script src="{{ asset('template/js/jquery.js') }}"></script>
        <script src="{{ asset('template/js/sweetalert.js') }}"></script>
    </head>

    <body>

        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('app') }}" class="logo-min d-flex align-items-center">
                    <img src="{{ asset('template/img/favicon.png') }}" width="58">
                    <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>

            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="GET" action="">
                    <input type="text" name="search" placeholder="Pesquisar" title="Pesquisar">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#"><i class="bi bi-search"></i></a>
                    </li>

                    @php
                        $nameParts = explode(' ', Auth::user()->name);
                        $firstName = $nameParts[0];
                        $secondyName = isset($nameParts[1]) ? $nameParts[1] : '';
                    @endphp
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile" class="rounded-circle">
                            @else
                                <img src="{{ asset('template/img/components/profile.png') }}" alt="Profile" class="rounded-circle">
                            @endif
                            <span class="dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ $firstName }} {{ $secondyName }}</h6>
                                <span>{{ Auth::user()->cpfcnpj }}</span>
                            </li>
                            <li> <hr class="dropdown-divider"> </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="">
                                    <i class="bi bi-person"></i>
                                    <span>Perfil</span>
                                </a>
                            </li>
                            <li> <hr class="dropdown-divider"> </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sair</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('app') }}"><i class="bi bi-bar-chart-fill"></i> <span>Dashboard</span> </a>
                </li>

                <li class="nav-heading">Gestão</li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#cotacao" data-bs-toggle="collapse" href="#">
                      <i class="bx bxs-news"></i><span>Cotação</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="cotacao" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('list-product') }}">
                                <i class="bi bi-circle"></i><span>Produtos</span>
                            </a>
                            <a href="{{ route('price') }}">
                                <i class="bi bi-circle"></i><span>Cotação</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                      <i class="ri-account-pin-box-line"></i><span>Usuários</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('list-user', ['role' => 'admin']) }}">
                                <i class="bi bi-circle"></i><span>Administradores</span>
                            </a>
                            <a href="{{ route('list-user', ['role' => 'user']) }}">
                                <i class="bi bi-circle"></i><span>Colaboradores</span>
                            </a>
                            <a href="{{ route('list-user', ['role' => 'client']) }}">
                                <i class="bi bi-circle"></i><span>Clientes</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i><span>Sair</span></a>
                </li>
            </ul>

        </aside>

        <main id="main" class="main">
            @yield('conteudo')
        </main>

        <footer id="footer" class="footer">
            <div class="copyright"> &copy; Copyright <strong><span>{{ env('APP_NAME') }} - {{ env('APP_GOV') }}</span></strong>. Todos os direitos reservados </div>
            <div class="credits">
                Desenvolvido por <a href="#">BSM INFORMÁTICA</a>
            </div>
        </footer>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('template/js/main.js') }}"></script>
        <script>

            @if ($errors->any())
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}\n';
                @endforeach
                
                Swal.fire({
                    title: 'Atenção!',
                    text: errorMessages,
                    icon: 'info',
                    timer: 5000,
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: 'Erro!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    timer: 3000
                })
            @endif

            @if(session('info'))
                Swal.fire({
                    title: 'Informação!',
                    text: '{{ session('info') }}',
                    icon: 'info',
                    timer: 3000
                })
            @endif
            
            @if(session('success'))
                Swal.fire({
                    title: 'Sucesso!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 3000
                })
            @endif
        </script>

    </body>
</html>