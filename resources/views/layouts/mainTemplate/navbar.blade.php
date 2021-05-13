<nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (request()->route()->getName() == 'home') ? 'active' : '' }}">
                <a class="nav-link" href="/">home</a>
            </li>
            @if(auth()->check() && auth()->user()->id == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('adminPosts') }}">posts</a>
                        <a class="dropdown-item" href="{{ route('adminCategories') }}">categories</a>
                        <a class="dropdown-item" href="{{ route('adminComments') }}">comments</a>
                        <a class="dropdown-item" href="{{ route('adminTags') }}">tags</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>

    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="/">GalleryLivewire</a>
    </div>

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link">Hi {{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                </li>
            @else
                <li class="nav-item {{ (request()->route()->getName() == 'login') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item {{ (request()->route()->getName() == 'register') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endif
        </ul>
    </div>

</nav>
