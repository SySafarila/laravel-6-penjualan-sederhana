@if (Auth::user()->role->name == 'buyer')
    <li class="nav-item">
        {{-- <a href="{{ route('carts.index') }}" class="align-items-center d-md-flex d-none nav-link position-relative">
            <span class="material-icons">shopping_cart</span>
            <span class="badge badge-pill badge-success mb-4 ml-1 ml-3 position-absolute">{{ Auth::user()->carts->count() }}</span>
        </a>
        <a href="{{ route('carts.index') }}" class="align-items-center d-flex d-md-none nav-link">
            <span>Carts</span>
            <span class="badge badge-success ml-1">{{ Auth::user()->carts->count() }}</span>
        </a> --}}
        <a href="{{ route('carts.index') }}" class="align-items-center d-flex nav-link">
            <span>Carts</span>
            <span class="badge badge-success ml-1">{{ Auth::user()->carts->count() }}</span>
        </a>
    </li>
@endif
