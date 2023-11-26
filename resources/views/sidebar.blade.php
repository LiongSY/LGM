<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <h2 class="nav-link">Customer List</h2>
            </li>
            @foreach ($customers as $customer)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chat.index', ['customer_id' => $customer->id]) }}">
                        {{ $customer->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>