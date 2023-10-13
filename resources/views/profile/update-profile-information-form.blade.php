<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Informações de Perfil') }}</h4>
            <p class="card-description">{{ __('Atualize os dados refentes a nome e email da sua conta.') }}</p>
        </div>
        <div class="card-body">

            <x-maz-alert class="mr-3" on="saved" color='success'>
                {{ __('Atualizado.') }}
            </x-maz-alert>
            <form wire:submit.prevent="updateProfileInformation">
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           wire:model.defer="state.name" autocomplete="name">
                    <x-maz-input-error for="name"/>
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}"/>
                    <input type="email" name="email " id="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           wire:model.defer="state.email">
                    <x-maz-input-error for="email"/>
                </div>

                <button class="btn bg-orange float-end mt-2" wire:loading.attr="disabled" wire:target="photo">
                    Atualizar
                </button>
            </form>
        </div>
    </div>
</section>
