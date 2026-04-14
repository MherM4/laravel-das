<header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 50px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); font-family: sans-serif;">

    <div style="display: flex; align-items: center; gap: 30px;">
        <nav>
            <a href="{{ route('home') }}" style="text-decoration: none; color: #333; font-weight: bold; font-size: 18px;">Գլխավոր</a>
        </nav>

        <a href="{{ route('profile') }}" style="text-decoration: none; color: #333; display: flex; align-items: center; gap: 12px;">
            <img src="{{ auth()->user()->avatar_url }}"
                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #007bff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <strong style="font-size: 15px;">{{ auth()->user()->name }}</strong>
        </a>
    </div>

    <nav style="display: flex; align-items: center; gap: 25px;">

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
            <a href="{{ route('admin.users') }}" style="text-decoration: none; color: #555; font-size: 14px;">Օգտատերեր</a>

            <a href="{{ route('admin.trash') }}" style="text-decoration: none; color: #dc3545; font-weight: bold; font-size: 14px; border: 1px solid #dc3545; padding: 4px 8px; border-radius: 4px;">
                ⚠️ Admin Աղբաման
            </a>
        @endif

        <a href="{{ route('posts.manage') }}" style="text-decoration: none; color: #333; font-size: 15px;">Իմ Գրառումները</a>

        <a href="{{ route('posts.trash') }}"
           style="text-decoration: none; color: #6c757d; font-weight: 500; font-size: 15px; display: flex; align-items: center; gap: 5px; transition: 0.3s;"
           onmouseover="this.style.color='#dc3545'"
           onmouseout="this.style.color='#6c757d'">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Իմ Աղբամանը
        </a>

        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background: #ff4d4d; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;">
                Ելք
            </button>
        </form>
    </nav>
</header>
