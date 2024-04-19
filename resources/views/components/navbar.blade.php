
{{-- tolto il fixed top perchè creava probelmi nelle pagine di dashboard --}}
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a class="logo d-flex align-items-center" href="{{ route('homepage') }}">
            <img src="{{ url('/storage/images/logo.png') }}" class="navLogo"  height="40"  alt="MDB Logo" loading="lazy" />
            <h4 class="m-2">Il faro</h4>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link" href="{{ route('careers') }}"> Lavora con noi</a></li>
                <li><a class="nav-link" href="{{ route('article.index') }}"> Tutti gli Articoli</a></li>
                @guest
                    <li class= "nav-item dropdown justify nav-drop">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Visitatore <i 
                                class="bi bi-chevron-down dropdown-indicator ps-0 pt-0"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                            <li><a class="dropdown-item pe-3" href="{{ route('login') }}">Accedi</a></li>
                        </ul>
                    </li>
                @endguest
                @auth
                    <li class= "nav-item dropdown justify nav-drop">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Benvenuto {{ Auth::user()->name }} <i
                                class="bi bi-chevron-down dropdown-indicator ps-0 pt-0"></i>
                        </a>
                        <ul class="nav-drop">
                            @auth
                                @if (Auth::user()->is_writer)
                                    <li><a class="nav-link" href="{{ route('article.create') }}"> Inserisci nuovo articolo</a>
                                    </li>
                                @endif


                                {{-- questo bottone sarà visibile solo dall'account admin, una volta effettuato l'accesso --}}
                                @if (Auth::user()->is_admin)
                                    <li><a class="nav-link" href="{{ route('admin.dashboard') }}"> DashBoard Admin</a></li>
                                @endif

                                @if (Auth::user()->is_revisor)
                                    <li><a class="nav-link" href="{{ route('revisor.dashboard') }}"> DashBoard Dei Revisori</a>
                                    </li>
                                @endif

                                @if (Auth::user()->is_writer)
                                    <li><a class="nav-link" href="{{ route('writer.dashboard') }}"> DashBoard Dei Redattori</a>
                                    </li>
                                @endif

                            @endauth
                            <li>
                                <form action="{{ route('logout')}}" id="logout-form" method="POST">
                                    @csrf
                                    <button type="submit" class="btn dropdown ps-3 button-logout">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
                @if (request()->route()->getName() !== 'article.index')
                    <li class="nav-drop">
                        <div class="container-fluid">
                            <form class="d-flex input-group w-auto" method="GET" action="{{ route('article.search') }}">
                            @csrf
                                <input type="search" class="form-control rounded-0" placeholder="Cerca" aria-label="Search"
                            aria-describedby="search-addon" name="query" />
                            </form>
                        </div>
                    </li>
                @endif 
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative navbar" id="navbar">
            <ul>
                @guest
                    <li class= "nav-item dropdown justify">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Visitatore <i 
                                class="bi bi-chevron-down dropdown-indicator ps-0 pt-0"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                            <li><a class="dropdown-item pe-3" href="{{ route('login') }}">Accedi</a></li>
                        </ul>
                    </li>
                @endguest
                @auth
                    <li class= "nav-item dropdown justify">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Benvenuto {{ Auth::user()->name }} <i
                                class="bi bi-chevron-down dropdown-indicator ps-0 pt-0"></i>
                        </a>
                        <ul >
                            @auth
                                @if (Auth::user()->is_writer)
                                    <li><a class="nav-link" href="{{ route('article.create') }}"> Inserisci nuovo articolo</a>
                                    </li>
                                @endif


                                {{-- questo bottone sarà visibile solo dall'account admin, una volta effettuato l'accesso --}}
                                @if (Auth::user()->is_admin)
                                    <li><a class="nav-link" href="{{ route('admin.dashboard') }}"> DashBoard Admin</a></li>
                                @endif

                                @if (Auth::user()->is_revisor)
                                    <li><a class="nav-link" href="{{ route('revisor.dashboard') }}"> DashBoard Dei Revisori</a>
                                    </li>
                                @endif

                                @if (Auth::user()->is_writer)
                                    <li><a class="nav-link" href="{{ route('writer.dashboard') }}"> DashBoard Dei Redattori</a>
                                    </li>
                                @endif

                            @endauth
                            <li>
                                <form action="{{ route('logout')}}" id="logout-form" method="POST">
                                    @csrf
                                    <button type="submit" class="btn dropdown ps-3 button-logout">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
                @if (request()->route()->getName() !== 'article.index')
                    <li>
                        <div class="container-fluid">
                            <form class="d-flex input-group w-auto" method="GET" action="{{ route('article.search') }}">
                            @csrf
                                <input type="search" class="form-control rounded-0" placeholder="Cerca" aria-label="Search"
                            aria-describedby="search-addon" name="query" />
                            </form>
                        </div>
                    </li>
                @endif 
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div>

    </div>

    </div>

</header>
