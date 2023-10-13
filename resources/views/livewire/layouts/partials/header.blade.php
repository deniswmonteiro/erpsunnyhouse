@if (!\Illuminate\Support\Facades\Auth::user()->status)
    {{     redirect('/logout')}}
    {{--    {{session(['error'=>'Usuário Bloqueado no sistema, contate um Adminstraor.'])}};--}}
    {{--    {{\Illuminate\Support\Facades\Auth::logout()}}--}}

    {{--    <script>window.location = "/logout";</script>--}}
@endif
<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        {{--                    <li class="nav-item dropdown me-1">--}}
                        {{--                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"--}}
                        {{--                            aria-expanded="false">--}}
                        {{--                            <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>--}}
                        {{--                        </a>--}}
                        {{--                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">--}}
                        {{--                            <li>--}}
                        {{--                                <h6 class="dropdown-header">Mail</h6>--}}
                        {{--                            </li>--}}
                        {{--                            <li><a class="dropdown-item" href="#">No new mail</a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                        {{--                    <li class="nav-item dropdown me-3">--}}
                        {{--                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"--}}
                        {{--                            aria-expanded="false">--}}
                        {{--                            <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>--}}
                        {{--                        </a>--}}
                        {{--                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">--}}
                        {{--                            <li>--}}
                        {{--                                <h6 class="dropdown-header">Notifications</h6>--}}
                        {{--                            </li>--}}
                        {{--                            <li><a class="dropdown-item">No notification available</a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">
                                        {{Auth::user()->name}}
                                    </h6>
                                    <p class="mb-0 text-sm text-primary">
                                        {{Auth::user()->email}}
                                    </p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="{{asset('/images/faces/1.jpg')}}">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow p-0 mt-2"
                            aria-labelledby="dropdownMenuButton">
                            <li class="bg-secondary bg-gradient rounded-top pt-1 pb-1">
                                <h6 class="dropdown-header text-light">
                                    Olá, {{strtok(Auth::user()->name, ' ')}}
                                </h6>
                            </li>

                            @if (Auth::user()->category_id == 1)
                                <hr class="dropdown-divider m-0">

                                <li class="pt-1 pb-1">
                                    <a href="{{route('edit_user', ['id' => encrypt(\Illuminate\Support\Facades\Auth::id())])}}" class="dropdown-item">
                                        <i class="bi bi-person-fill me-2"></i>
                                        Meu Perfil
                                    </a>
                                </li>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <li class="pt-1 pb-1">
                                    <a href="#" class="dropdown-item">
                                        <i class="bi bi-gear me-2"></i>
                                        {{ __('API Tokens') }}
                                    </a>
                                </li>
                            @endif
                            
                            <hr class="dropdown-divider m-0">

                            <li class="pt-1 pb-1">
                                <a href="{{route('logout')}}" class="dropdown-item">
                                    <i class="bi bi-box-arrow-left me-2"></i>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
