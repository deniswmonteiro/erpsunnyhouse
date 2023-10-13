<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{route('dashboard')}}">
                        <img src="{{asset('images/logo/logo.png')}}" alt="Logo da Sunny House">
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title text-muted">Menu Principal</li>

                @if (Auth::user()->category_id != 2)
                    <!-- Dashboard -->
                    <li class="sidebar-item @if (has_active_url(['dashboard'])) active @endif">
                        <a href="{{route('dashboard')}}" class="sidebar-link lh-1 pt-3 pb-3">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Sales -->
                    <li class="sidebar-item has-sub @if (has_active_url(['client', 'seller', 'contracts/create', 'contracts/installation', 'contracts/maintenance', 'engineering/create'])) active @endif">
                        <a href="#" class="sidebar-link lh-1 pt-3 pb-3">
                            <i class="bi bi-cart-fill"></i>
                            <span>Vendas</span>
                        </a>
                        <ul class="submenu @if (has_active_url(['client', 'seller', 'contracts/create', 'contracts/installation', 'contracts/maintenance', 'engineering/create', 'costs/create'])) active @endif">
                            <!-- Contracts - Installation -->
                            <li class="submenu-item @if (has_active_url(['contracts/installation', 'engineering/create'])) active @endif">
                                <a href="{{route('contracts_installation')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-clipboard-data-fill me-1"></i>
                                    <span>Contratos de Instalação</span>
                                </a>
                            </li>

                            <!-- Contracts - Maintenance -->
                            <li class="submenu-item @if (has_active_url(['contracts/maintenance'])) active @endif">
                                <a href="{{route('contracts_maintenance')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-clipboard-data-fill me-1"></i>
                                    <span>Contratos de Manutenção</span>
                                </a>
                            </li>

                            <!-- Client -->
                            <li class="submenu-item @if (has_active_url(['client'])) active @endif">
                                <a href="{{ route('clients_index') }}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-person-lines-fill me-1"></i>
                                    <span>Clientes</span>
                                </a>
                            </li>

                            <!-- Seller -->
                            <li class="submenu-item @if (has_active_url(['seller']) && !has_active_url(['sellersTeam'])) active @endif">
                                <a href="{{route('sellers_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-file-person-fill me-1"></i>
                                    <span>Vendedores</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Tickets -->
                <li class="sidebar-item @if (has_active_url(['tickets'])) active @endif">
                    <a href="{{route('tickets_index')}}"
                        class="sidebar-link lh-1 pt-3 pb-3">
                        <i class="bi bi-ticket-fill me-1"></i>
                        <span>Tickets/OS</span>
                    </a>
                </li>

                <!-- Engineering -->
                <li class="sidebar-item @if (has_active_url(['engineering']) && !has_active_url(['engineering/create'])) active @endif">
                    <a href="{{route('engineering_project_index')}}"
                        class="sidebar-link lh-1 pt-3 pb-3">
                        <i class="bi bi-gear-fill me-1"></i>
                        <span>Engenharia</span>
                    </a>
                </li>

                @if (Auth::user()->category_id != 2)
                    {{-- <!-- Project Costs -->
                    <li class="sidebar-item @if (has_active_url(['costs']) && !has_active_url(['costs/create'])) active @endif ">
                        <a href="{{ route('costs_index') }}"
                            class="sidebar-link lh-1 pt-3 pb-3">
                            <i class="bi bi-coin me-1"></i>
                            <span>Custos dos Projetos</span>
                        </a>
                    </li> --}}

                    <!-- Management -->
                    <li class="sidebar-item has-sub @if (has_active_url(['bank','log','user','equipment'])) active @endif">
                        <a href="#" class="sidebar-link lh-1 pt-3 pb-3">
                            <i class="bi bi-tools"></i>
                            <span>Gerenciamento</span>
                        </a>
                        <ul class="submenu @if (has_active_url(['bank','log','user','equipment'])) active @endif">
                            <li class="submenu-item @if(has_active_url(['bank'])) active @endif">
                                <a href="{{route('banks_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-bank2 me-1"></i>
                                    <span>Bancos Aceitos</span>
                                </a>
                            </li>
                            <li class="submenu-item @if (has_active_url(['equipment'])) active @endif">
                                <a href="{{route('equipments_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-cpu-fill me-1"></i>
                                    <span>Equipamentos</span>
                                </a>
                            </li>
                            <li class="submenu-item @if (has_active_url(['user'])) active @endif">
                                <a href="{{route('users_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-people-fill me-1"></i>
                                    <span>Usuários</span>
                                </a>
                            </li>
                            <li class="submenu-item @if (has_active_url(['log'])) active @endif">
                                <a href="{{route('logs_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-file-earmark-text-fill me-1"></i>
                                    <span>Ver Logs</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->category_id == 1)
                    <li class="sidebar-item has-sub @if (has_active_url(['sunnypark/contratos','sunnypark/usinas/beneficiarias','sunnypark/usinas','sunnypark/dashboard'])) active @endif">
                        <a href="#" class="sidebar-link lh-1 pt-3 pb-3">
                            <i class="bi bi-sun-fill"></i>
                            <span>Sunny Park</span>
                        </a>
                        <ul class="submenu @if (has_active_url(['sunnypark/contratos','sunnypark/usinas/beneficiarias','sunnypark/usinas','sunnypark/dashboard'])) active @endif">
                            <li class="submenu-item @if (has_active_url(['sunnypark/dashboard'])) active @endif">
                                <a href="{{route('sunnypark_dash_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-grid-fill me-1"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="submenu-item @if (has_active_url(['sunnypark/contratos'])) active @endif">
                                <a href="{{ route('sunnypark_contratos_index') }}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-clipboard-data-fill me-1"></i>
                                    <span>Contratos</span>
                                </a>
                            </li>
                            <li class="submenu-item @if (has_active_url(['sunnypark/usinas/beneficiarias'])) active @endif">
                                <a href="{{route('sunnypark_contascontratos_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-lightbulb-fill me-1"></i>
                                    <span>Beneficiárias</span>
                                </a>
                            </li>
                            <li class="submenu-item @if (has_active_url(['sunnypark/usinas'])) active @endif">
                                <a href="{{route('sunnypark_usinas_index')}}"
                                    class="d-flex align-items-center lh-1 pt-2 pb-2 mt-2 mb-2">
                                    <i class="bi bi-plug-fill me-1"></i>
                                    <span>Usinas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>