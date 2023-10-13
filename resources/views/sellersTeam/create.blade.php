@section('page_title', 'Adicionar Vendedor')

<script src="{{asset(mix('js/sellers/create.js'))}}" defer></script>
<script>
    var url_ajax_email = "{{route('sellers_validate_email')}}";
    var url_ajax_store_team = "{{route('teams_store_ajax')}}";
    var teams = @json($teams);
</script>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Cadastrar Um Novo Vendedor')}}</h3>
                <p class="text-subtitle text-muted">{{_('Insira no formulário os dados do novo vendedor.')}}</p>
            </div>
        </div>
    </x-slot>

    <div>
        <form action="{{route('sellers_store')}}" method="POST" onsubmit="return window.submit_form_seller_create()">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Perfil</h4>
                </div>
                <div class="card-body">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input id="name" type="text" value="{{old('name')}}" name="name"
                               class="form-control" required minlength="5">
                        <div class="invalid-feedback" id="name_feedback">
                            Mínimo de 5 Caracterres.
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}"
                               class="form-control" required>
                        <div class="invalid-feedback" id="email_feedback">
                            Formato incorreto.
                        </div>
                    </div>

                    <!-- Team -->
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="team">Time de Vendas</label>
                            <input id="team" type="text"
                                   name="team"
                                   value=""
                                   class="form-control"
                                   autocomplete="off" required>
                            <div class="invalid-feedback">
                                <button id="new_team" type="button" class="btn btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_new_team">
                                    Inserir Time de Vendas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Contato</h4>
                </div>
                <div class="card-body">
                    <!-- Telefone -->
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input id="phone" type="text" value="{{old('phone')}}" name="phone"
                               class="form-control" required minlength="15">
                        <div class="invalid-feedback">
                            Formato incorreto.
                        </div>
                    </div>

                    <div class="row">
                        <!-- CEP -->
                        <div class="form-group col-12 col-md-12 col-lg-2">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" id="cep" value="{{old('cep')}}"
                                   class="form-control">
                            <div class="invalid-feedback">
                                Formato incorreto.
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="form-group col-12 col-md-12 col-lg-8">
                            <label for="address">Endreço</label>
                            <input type="text" name="address" id="address" value="{{old('address')}}"
                                   class="form-control" >
                            <div class="invalid-feedback">
                                Formato incorreto.
                            </div>
                        </div>

                        <!-- Numero -->
                        <div class="form-group col-12 col-md-12 col-lg-2">
                            <label for="number">Número/Apt</label>
                            <input type="text" name="number" id="number" value="{{old('number')}}"
                                   class="form-control">
                            <div class="invalid-feedback">
                                Formato incorreto.
                            </div>
                        </div>

                        <!-- Complemento -->
                        <div class="form-group col-12 col-md-12 col-lg-12">
                            <label for="complement">Complemento</label>
                            <input type="text" name="complement" id="complement" value="{{old('complement')}}"
                                   class="form-control">
                            <div class="invalid-feedback">
                                Formato incorreto.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2 offset-10">
                                <button class="btn bg-orange float-end mt-2"
                                        onsubmit="return window.submit_form_user_create()">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Team -->
    <div class="modal fade w-100" id="modal_new_team"
         style="color: black"
         tabindex="-1" role="dialog" aria-hidden="true"
         aria-labelledby="modal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
             role="document">
            <div class="modal-content">
                <button type="button" class="btn-close align-self-end m-1" data-bs-dismiss="modal"
                        aria-label="close"></button>
                <div class="modal-header">
                    <h5 class="modal-title">Insira os dados do novo time</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="#" method="post" onsubmit="return false">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informações de Time de Vendas</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="team-name">Nome</label>
                                        <input id="team-name" type="text" value="" name="team-name"
                                               class="form-control" required minlength="5">
                                        <div class="invalid-feedback" id="name-feedback-team">
                                            Mínimo de 5 Caracterres.
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Voltar
                    </button>
                    <form action="#" onsubmit="return false"
                          method="post" style="margin-block-end: 0!important;">

                        <button class="btn bg-success text-white"
                                type="button" id="btn-create-team">
                            Cadastrar Novo Time
                        </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
