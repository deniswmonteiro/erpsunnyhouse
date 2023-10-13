<div class="modal fade text-black"
    id="modal-show-client"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal-show-client">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informações do Cliente</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Profile Informations -->
                <div class="card border">
                    <div class="card-header bg-blue-lighten p-3">
                        <h4 class="card-title mb-0">Informações de Perfil</h4>
                    </div>
                    <div class="card-body pt-4 pb-0">
                        @if ($contract->client->is_corporate)
                            <div class="row">
                                <!-- Corporate Name -->
                                <div class="col-12 col-lg-4 mb-3">
                                    <span class="fw-bold">Razão Social:</span>
                                    <p>{{$contract->client->corporate_name}}</p>
                                </div>

                                <!-- CNPJ -->
                                <div class="col-12 col-lg-4 mb-3">
                                    <span class="fw-bold">CNPJ:</span>
                                    <p>{{$contract->client->cnpj}}</p>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Name -->
                            <div class="col-12 col-lg-4 mb-3">
                                <span class="fw-bold">Nome:</span>
                                <p>{{$contract->client->name}}</p>
                            </div>

                            <!-- Birth Date -->
                            <div class="col-12 col-lg-4 mb-3">
                                <span class="fw-bold">Data de Nascimento:</span>
                                <p>{{date('d/m/Y', strToTime($contract->client->birth_date))}}</p>
                            </div>

                            <!-- CPF -->
                            <div class="col-12 col-lg-4 mb-3">
                                <span class="fw-bold">CPF:</span>
                                <p>{{$contract->client->cpf}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Email -->
                            <div class="col-12 col-lg-4 mb-3">
                                <span class="fw-bold">Email:</span>
                                <p>{{$contract->client->email}}</p>
                            </div>

                            <!-- Phone -->
                            <div class="col-12 col-lg-4 mb-3">
                                <span class="fw-bold">Telefone:</span>
                                <p>{{$contract->client->phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Informations -->
                <div class="card border">
                    <div class="card-header bg-blue-lighten p-3">
                        <h4 class="card-title mb-0">Informações de Endereço</h4>
                    </div>
                    <div class="card-body pt-4 pb-0">
                        <div class="row">
                            <!-- CEP -->
                            <div class="col-12 col-md-3 mb-3">
                                <span class="fw-bold">CEP:</span>
                                <p>{{$contract->client->address_cep}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Address -->
                            <div class="col-12 col-md-4 mb-3">
                                <span class="fw-bold">Endereço:</span>
                                <p>{{$contract->client->address}}</p>
                            </div>

                            <!-- Number -->
                            <div class="col-12 col-md-4 mb-3">
                                <span class="fw-bold">Número:</span>
                                <p>{{$contract->client->address_number}}</p>
                            </div>

                            <!-- Complement -->
                            <div class="col-12 col-md-4 mb-3">
                                <span class="fw-bold">Complemento:</span>
                                <p>{{$contract->client->address_complement}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Neighborhood -->
                            <div class="col-12 col-md-4 mb-3">
                                <span class="fw-bold">Bairro:</span>
                                <p>{{$contract->client->address_neighborhood}}</p>
                            </div>

                            <!-- City -->
                            <div class="col-12 col-md-4 mb-3">
                                <span class="fw-bold">Cidade:</span>
                                <p>{{$contract->client->address_city}}</p>
                            </div>

                            <!-- State -->
                            <div class="col-12 col-md-4 mb-3">
                                <span class="fw-bold">Estado:</span>
                                <p>{{$contract->client->address_state}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Equatorial Credentials -->
                <div class="card border">
                    <div class="card-header bg-blue-lighten p-3">
                        <h4 class="card-title mb-0">Credenciais Equatorial</h4>
                    </div>
                    <div class="card-body pt-4 pb-0">
                        <div class="row">
                            <!-- Login -->
                            <div class="col-12 col-md-6 mb-3">
                                <span class="fw-bold">Login:</span>
                                <p>
                                    @if ($contract->client->login != null)
                                        {{$contract->client->login}}
                                    @else
                                        &mdash;
                                    @endif
                                </p>
                            </div>

                            <!-- Password -->
                            <div class="col-12 col-md-6 mb-3">
                                <span class="fw-bold">Senha:</span>
                                <p>
                                    @if ($contract->client->password != null)
                                        {{$contract->client->password}}
                                    @else
                                        &mdash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>