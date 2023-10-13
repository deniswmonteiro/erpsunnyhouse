@section('page_title', 'Adicionar Custo do Projeto de Engenharia')

<script src="{{asset(mix('js/costs/create.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>{{_('Adicionar Custos do Projeto de Engenharia')}}</h3>
                <p class="text-subtitle text-muted">{{_('Custos das obras do projeto.')}}</p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <section>
        <form action="{{route('costs_store', ['id' => encrypt($project->id)])}}" method="POST"
            id="form-create-cost-project"
            onsubmit="return window.submitFormCreateCostProject()">
            @csrf

            <!-- Contract Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações do Contrato</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Contract Date -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <span class="fw-bold">Data de Criação:</span>
                                <p>{{$project->contract->created_at->format('d/m/Y')}}</p>
                            </div>
                        </div>

                        <!-- Installation Deadline -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <span class="fw-bold">Data de Conclusão:</span>
                                <p>{{date('d/m/Y', strToTime($project->contract->installation_deadline))}}</p>
                            </div>
                        </div>

                        <!-- Client -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <span class="fw-bold">Cliente:</span>
                                <p id="client">
                                    @if ($project->contract->client->is_corporate)
                                        {{$project->contract->client->corporate_name}}
                                    @else {{$project->contract->client->name}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Seller -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <span class="fw-bold">Vendedor:</span>
                                <p>{{$project->contract->seller->name}}</p>
                            </div>
                        </div>

                        <!-- Value -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <span class="fw-bold">Valor do Contrato:</span>
                                <p>R$ {{format_money($project->contract->paymentData()->value)}}</p>
                            </div>
                        </div>

                        <!-- Payment Type -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <span class="fw-bold">Tipo de Pagamento:</span>
                                <p>
                                    {{mb_convert_case(Str::lower($project->contract->payment->type->name), MB_CASE_TITLE)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Solar Kit -->
            <div class="card" id="generator">
                <div class="card-header">
                    <h4 id="label_generator" class="card-title">
                        Itens do Kit Solar &ndash; {!! $project->contract->getGeneratorPower() !!}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Structure Type -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Tipo de Estrutura:</span>
                                @switch ($project->contract->generator_structure)
                                    @case (1)
                                        <p>Solo Monoposte</p>
                                        @break
                                    
                                    @case (2)
                                        <p>Laje</p>
                                        @break
                                    
                                    @case (3)
                                        <p>Fibrocimento</p>
                                        @break
                                    
                                    @case (4)
                                        <p>Cerâmico</p>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <!-- Area -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <span class="fw-bold">Área Configurada (m<sup>2</sup>):</span>
                            <p>{{$project->contract->area}}</p>
                        </div>

                        <!-- Monthly Average Generation -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <span class="fw-bold">Geração Média Mensal (kWh):</span>
                            <p id="monthly-avg-generation">{{$project->contract->monthly_avg_generation}}</p>
                        </div>

                        <!-- Products Generator -->
                        <div class="col-12 col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-hover" id="editable-table" name="editable-table">
                                    <thead class="border border-gray bg-blue-lighten">
                                        <tr>
                                            <th scope="col" class="text-primary ps-4 pt-3 pe-4 pb-3">Produto</th>
                                            <th scope="col" class="text-primary ps-4 pt-3 pe-4 pb-3">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-gray pt-4 pb-2">
                                        @foreach ($project->contract->contractsProducts() as $product)
                                            <tr>
                                                <td class="ps-4 pt-3 pe-4 pb-3">{{$product->name}}</td>
                                                <td class="ps-4 pt-3 pe-4 pb-3">{{$product->quantity}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $forms = [
                    [
                        'title' => 'Kit Fotovoltaico',
                        'type' => 'photovoltaic'
                    ],
                    [
                        'title' => 'Projeto',
                        'type' => 'project'
                    ],
                    [
                        'title' => 'Mão de Obra',
                        'type' => 'labor'
                    ],
                    [
                        'title' => 'Insumos',
                        'type' => 'supplies'
                    ],
                    [
                        'title' => 'Serviços',
                        'type' => 'services'
                    ],
                    [
                        'title' => 'Outros',
                        'type' => 'others'
                    ],
                ]
            @endphp

            @for ($i = 0; $i < count($forms); $i++)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$forms[$i]['title']}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Description -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="cost-{{$forms[$i]['type']}}-description" class="form-label">
                                        Descrição
                                    </label>
                                    <input class="form-control" type="text"
                                        id="cost-{{$forms[$i]['type']}}-description"
                                        name="cost-{{$forms[$i]['type']}}-description"
                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback"
                                        id="cost-feedback-{{$forms[$i]['type']}}-description"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Value -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="cost-{{$forms[$i]['type']}}-description" class="form-label">
                                        Valor
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input class="form-control" type="text"
                                            id="cost-{{$forms[$i]['type']}}-description"
                                            name="cost-{{$forms[$i]['type']}}-description"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                    </div>
                                    <div class="invalid-feedback"
                                        id="cost-feedback-{{$forms[$i]['type']}}-description"></div>
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="cost-{{$forms[$i]['type']}}-date" class="form-label">
                                        Data
                                    </label>
                                    <input class="form-control date" type="date"
                                        id="cost-{{$forms[$i]['type']}}-date"
                                        name="cost-{{$forms[$i]['type']}}-date"
                                        value="{{date('Y-m-d')}}"
                                        onkeyup="return window.validateDate(this)"
                                        onblur="return window.validateDate(this)"
                                        onchange="return window.validateDate(this)">
                                    <div class="invalid-feedback"
                                        id="cost-feedback-{{$forms[$i]['type']}}-date"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Stage -->
                        <div class="row">
                            <h6 class="mt-4 mb-3">Etapa</h6>

                            <!-- Structure -->
                            <div class="col-12 col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="cost-{{$forms[$i]['type']}}-structure" class="form-label">
                                        Estrutura
                                    </label>
                                    <input class="form-control" type="text"
                                        id="cost-{{$forms[$i]['type']}}-structure"
                                        name="cost-{{$forms[$i]['type']}}-structure"
                                        @if ($forms[$i]['type'] == 'photovoltaic' || $forms[$i]['type'] == 'project')
                                            value=@switch ($project->contract->generator_structure)
                                                    @case (1)
                                                        {{'Solo Monoposte'}}
                                                        @break
                                                    
                                                    @case (2)
                                                        {{'Laje'}}
                                                        @break
                                                    
                                                    @case (3)
                                                        {{'Fibrocimento'}}
                                                        @break
                                                    
                                                    @case (4)
                                                        {{'Cerâmico'}}
                                                        @break
                                                @endswitch
                                        @endif
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback"
                                        id="cost-feedback-{{$forms[$i]['type']}}-structure"></div>
                                </div>
                            </div>

                            <!-- Inverter -->
                            <div class="col-12 col-md-5 mb-3">
                                <div class="form-group">
                                    <label for="cost-{{$forms[$i]['type']}}-inverter" class="form-label">
                                        Inversor
                                    </label>
                                    <input class="form-control" type="text"
                                        id="cost-{{$forms[$i]['type']}}-inverter"
                                        name="cost-{{$forms[$i]['type']}}-inverter"
                                        @if ($forms[$i]['type'] == 'photovoltaic' || $forms[$i]['type'] == 'project')
                                            value="{{$inverter_model}}"
                                        @endif
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback"
                                        id="cost-feedback-{{$forms[$i]['type']}}-inverter"></div>
                                </div>
                            </div>

                            <!-- Input Pattern -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="cost-{{$forms[$i]['type']}}-pattern" class="form-label">
                                        Padrão de Entrada
                                    </label>
                                    <input class="form-control" type="text"
                                        id="cost-{{$forms[$i]['type']}}-pattern"
                                        name="cost-{{$forms[$i]['type']}}-pattern"
                                        @if ($forms[$i]['type'] == 'photovoltaic' || $forms[$i]['type'] == 'project')
                                            value=""
                                        @endif
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback"
                                        id="cost-feedback-{{$forms[$i]['type']}}-pattern"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

            <div class="row justify-content-end mt-3">
                <div class="col-12 col-md-3 d-flex justify-content-end">
                    <button class="btn bg-success text-white float-end d-flex align-items-center" 
                        type="submit"
                        id="btn-create-project-cost">
                        Salvar Informações
                    </button>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>