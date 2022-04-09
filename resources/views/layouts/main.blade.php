<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Borrow a book</title>

    <link rel="stylesheet" href="/css/app.css">

    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/journal/bootstrap.min.css" integrity="sha384-QDSPDoVOoSWz2ypaRUidLmLYl4RyoBWI44iA5agn6jHegBxZkNqgm2eHb6yZ5bYs" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Borrow book</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item {{ Route::currentRouteName() == '' ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'books.index' ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{ route('books.index') }}">Catalog</a>
                    </li>

                    @auth
                        <li class="nav-item {{ Route::currentRouteName() == 'borrows.index' ? 'active' : '' }}">
                            <a class="nav-link" aria-current="page" href="{{ route('borrows.index') }}">Borrows</a>
                        </li>
                    @endauth
                    @can('librarian')
                        <li class="nav-item {{ Route::currentRouteName() == 'genre.index' ? 'active' : '' }}">
                            <a class="nav-link" aria-current="page" href="{{ route('genres.index') }}">Genres</a>
                        </li>
                    @endcan
                </ul>
                <div class="d-flex text-light">
                    @auth
                    Hello, <a class="link-light" href="{{route('profile.index')}}">{{ request()->user()->name }}</a>.
                    <form class="ms-2" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="link-light">Logout</button>
                    </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="link-light">Login</a>
                        <a href="{{ route('register') }}" class="link-light ms-2">Register</a>
                    @endguest
                </div>

            </div>
        </div>
    </nav>
    <div class="container py-5">
        @yield('content')
    </div>
</body>

</html>
