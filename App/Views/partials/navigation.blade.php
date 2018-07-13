<aside class="sidebar">
    <div class="sidebar__top">
        <div class="sidebar__logo">
            <h1>PP</h1>
            <span>Password</span>
        </div>
    </div>
    <nav class="sidebar__nav">
        <ul>
            @if(!$Auth->check())
            <li class="sidebar__nav-item {{ checkIfActive('/login') }}"><a class="sidebar__nav-item-link" href="{{ route('login.index') }}">Login</a></li>
            <li class="sidebar__nav-item {{ checkIfActive('/register') }}"><a class="sidebar__nav-item-link" href="{{ route('register.index') }}">Register</a></li>
            @endif @if($Auth->check())
            <li class="sidebar__nav-item"><a class="sidebar__nav-item-link" href="{{ route('logout') }}">Logout</a></li>
            <li class="sidebar__nav-item {{ checkIfActive('/') }}"><a class="sidebar__nav-item-link" href="{{ route('index') }}">Dashboard</a></li>
            <li class="sidebar__nav-item {{ checkIfActive('/users') }}"><a class="sidebar__nav-item-link" href="{{ route('users') }}">Users</a></li>
            <li class="sidebar__nav-item {{ checkIfActive('/clients') }}"><a class="sidebar__nav-item-link" href="{{ route('clients') }}">Clients</a></li>   
            <li class="sidebar__nav-item {{ checkIfActive('/passwords') }}"><a class="sidebar__nav-item-link" href="{{ route('clients.passwords') }}">Passwords</a></li>          
            @endif
        </ul>
    </nav>
</aside>