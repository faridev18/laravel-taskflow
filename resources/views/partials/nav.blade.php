

<nav>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 hover:bg-blue-700 rounded">
                <i class="fas fa-home"></i>
                <span class="nav-text ml-3">Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin') }}" class="flex items-center p-2 hover:bg-blue-700 rounded">
                <i class="fas fa-user-cog"></i>
                <span class="nav-text ml-3">Admin</span>
            </a>
        </li>

        <li>
            <a href="{{ route('categories') }}" class="flex items-center p-2 hover:bg-blue-700 rounded">
                <i class="fa-solid fa-list"></i>
                <span class="nav-text ml-3">Catégories</span>
            </a>
        </li>

        <li>
            <a href="{{ route('products') }}" class="flex items-center p-2 hover:bg-blue-700 rounded">
                <i class="fa-solid fa-utensils"></i>
                <span class="nav-text ml-3">Products</span>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('profile') }}" class="flex items-center p-2 hover:bg-blue-700 rounded">
                <i class="fas fa-user"></i>
                <span class="nav-text ml-3">Profil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('settings') }}" class="flex items-center p-2 hover:bg-blue-700 rounded">
                <i class="fas fa-cog"></i>
                <span class="nav-text ml-3">Paramètres</span>
            </a>
        </li> --}}
    </ul>
</nav>

