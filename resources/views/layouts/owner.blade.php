<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Restro Nova</title>

    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            background: #f5f6fc;
            color: #20233f;
        }
        a { text-decoration: none; color: inherit; }
        .sidebar {
            width: 245px;
            background: #171d35;
            color: white;
            position: fixed;
            inset: 0 auto 0 0;
            padding: 28px 16px;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }
        .brand { font-size: 25px; font-weight: 800; padding: 4px 10px 34px; }
        .brand span { color: #a99aff; }
        .nav-link {
            display: block;
            padding: 14px 13px;
            margin-bottom: 7px;
            border-radius: 11px;
            color: #d4d8e9;
            font-size: 14px;
        }
        .nav-link:hover, .nav-link.active {
            background: linear-gradient(100deg, #6546ed, #4730c5);
            color: white;
        }
        .nav-label { padding: 12px 13px; color: #8e97b5; font-size: 11px; }
        .soon { opacity: .52; cursor: default; }
        .sidebar-bottom { margin-top: auto; padding: 15px 12px; color: #aeb5cf; font-size: 12px; }
        .main { margin-left: 245px; min-height: 100vh; }
        .topbar {
            height: 78px;
            padding: 0 34px;
            background: white;
            border-bottom: 1px solid #ececf5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }
        .search {
            width: min(350px, 48%);
            padding: 12px 15px;
            border: 1px solid #e7e8f2;
            background: #f8f9fd;
            border-radius: 10px;
            color: #777d98;
            font-size: 13px;
        }
        .user { font-size: 13px; font-weight: 600; }
        .logout { color: #e05269; margin-left: 15px; font-size: 13px; }
        .content { padding: 30px 34px; max-width: 1500px; margin: auto; }
        .hero {
            background: linear-gradient(110deg, #e9e2ff, #f5edff 65%, #e6edff);
            padding: 30px;
            border-radius: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        .hero h1 { font-size: clamp(23px, 3vw, 32px); margin: 0 0 10px; }
        .hero p { color: #666584; margin: 0; line-height: 1.7; }
        .btn {
            display: inline-block;
            background: #593be0;
            color: white;
            border: 0;
            border-radius: 10px;
            padding: 13px 18px;
            font-weight: 650;
            font-size: 13px;
            cursor: pointer;
        }
        .btn:hover { background: #4528c6; }
        .btn-light { background: white; color: #5638d5; border: 1px solid #ded8ff; }
        .stats { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 16px; margin-bottom: 25px; }
        .stat, .panel {
            background: white;
            border: 1px solid #e9eaf4;
            border-radius: 15px;
            padding: 21px;
            box-shadow: 0 4px 15px #28205b05;
        }
        .stat-icon { font-size: 23px; margin-bottom: 15px; }
        .stat-number { font-size: 28px; font-weight: 800; }
        .muted { color: #8287a0; font-size: 13px; }
        .section-head { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 18px; }
        .section-head h2 { margin: 0; font-size: 20px; }
        .restaurant-card {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 17px;
            border: 1px solid #ececf5;
            border-radius: 13px;
            margin-bottom: 13px;
        }
        .restaurant-photo {
            width: 115px; height: 105px; flex-shrink: 0;
            border-radius: 11px;
            background: linear-gradient(135deg, #eee8ff, #f8e8dc);
            display: grid; place-items: center; font-size: 35px;
        }
        .restaurant-info {
           flex: 1 1 250px;
           min-width: 250px;
        }

        .restaurant-info h3 {
           margin: 0 0 8px;
           font-size: 18px;
        }

        .restaurant-info p {
           margin: 5px 0;
           color: #777d96;
           font-size: 13px;
           overflow-wrap: break-word;
           word-break: normal;
        }
        .status { display: inline-block; background: #e3f8eb; color: #18874b; padding: 5px 9px; border-radius: 20px; font-size: 11px; margin-left: 8px; }
        .actions { display: flex; gap: 9px; flex-wrap: wrap; }
        .empty { text-align: center; padding: 40px 20px; }
        .empty .emoji { font-size: 45px; }
        .empty h3 { margin-bottom: 8px; }
        .empty p { color: #8287a0; font-size: 14px; margin-bottom: 20px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 19px; }
        .field { margin-bottom: 18px; }
        .field label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 650; }
        .field input, .field textarea {
            width: 100%; padding: 13px 14px; border: 1px solid #dfe2ef;
            border-radius: 9px; font: inherit; font-size: 13px; background: #fff;
        }
        .field input:focus, .field textarea:focus { outline: 2px solid #d8ceff; border-color: #765ce8; }
        .field textarea { min-height: 110px; resize: vertical; }
        .error { color: #c62845; font-size: 13px; }
        .success { background: #e5f8ed; color: #167544; padding: 13px 16px; border-radius: 10px; margin-bottom: 20px; }
        @media(max-width: 1050px) {
            .sidebar { width: 205px; }
            .main { margin-left: 205px; }
            .content { padding: 24px 20px; }
            .stats { grid-template-columns: repeat(2, minmax(0,1fr)); }
            .topbar { padding: 0 20px; }
        }
        @media(max-width: 650px) {
            .sidebar { position: static; width: 100%; padding: 15px; }
            .brand { padding: 4px 8px 15px; }
            .sidebar nav { display: flex; gap: 6px; overflow-x: auto; }
            .nav-link { white-space: nowrap; margin: 0; padding: 10px; }
            .nav-label, .sidebar-bottom, .soon { display: none; }
            .main { margin-left: 0; }
            .topbar { height: auto; padding: 15px; flex-wrap: wrap; }
            .search { width: 100%; }
            .content { padding: 18px 13px; }
            .hero { padding: 22px; flex-direction: column; align-items: flex-start; }
            .stats { gap: 10px; }
            .stat { padding: 15px; }
            .stat-number { font-size: 23px; }
            .restaurant-card { align-items: flex-start; flex-wrap: wrap; }
            .restaurant-photo { width: 82px; height: 82px; }
            .actions { width: 100%; }
            .form-grid { grid-template-columns: 1fr; gap: 0; }
        }
        @media(max-width: 650px) {
    .restaurant-info {
        flex: 1 1 calc(100% - 100px);
        min-width: 0;
        width: calc(100% - 100px);
    }
}
    </style>
</head>
<body>
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}">🍽 Restro <span>Nova</span></a>

        <nav>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">⌂ &nbsp; Dashboard</a>
            <a class="nav-link {{ request()->routeIs('restaurants.*') ? 'active' : '' }}" href="{{ route('restaurants.index') }}">▣ &nbsp; My Restaurants</a>
            <div class="nav-label">RESTAURANT TOOLS</div>
            <a class="nav-link {{ request()->routeIs('menu-items.*') ? 'active' : '' }}"
            href="{{ route('menu-items.index') }}">♨ &nbsp; Menu Management</a>
            <span class="nav-link soon">▤ &nbsp; Table Management</span>
            <span class="nav-link soon">🛍 &nbsp; Orders</span>
            <span class="nav-link soon">▦ &nbsp; Bookings</span>
            <span class="nav-link soon">♙ &nbsp; Staff &amp; Inventory</span>
            <span class="nav-link soon">⚙ &nbsp; Settings</span>
        </nav>

        <div class="sidebar-bottom">Manage. Serve. Grow.<br>© 2026 Restro Nova</div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="search">⌕ &nbsp; Your restaurant workspace</div>
            <div>
                <span class="user">👤 {{ auth()->user()->name }}</span>
                <a class="logout" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">@csrf</form>
            </div>
        </header>

        <section class="content">
            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </section>
    </main>
</body>
</html>
