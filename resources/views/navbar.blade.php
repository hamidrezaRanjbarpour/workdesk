<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{--        <a class="navbar-brand" href="#">خانه</a>--}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('working_hours.create') }}">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'working_hours.create' ? 'active' : '' }}"
                       href="{{ route('working_hours.create') }}">ثبت ساعت کاری</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'companies.index' ? 'active' : '' }}"
                       href="{{ route('companies.index') }}">
                        امور شرکت ها
                    </a>

                </li>
            </ul>

            <ul class="navbar-nav me-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">پروفایل</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout')}}">
                                @csrf
                                <a class="dropdown-item" href="" onclick="event.preventDefault();
                                                this.closest('form').submit();">خروج</a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
