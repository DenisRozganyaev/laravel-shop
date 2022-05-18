<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ h_secure_url('admin') }}">Admin panel:</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders') }}">{{ __('Orders List') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">{{ __('Products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.create') }}">{{ __('New Product') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
