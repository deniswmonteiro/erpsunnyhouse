<div class='card' submit="updatePassword">
    <div class="card-header">
        <h4 class="card-title">{{ __('Atualização de Senha') }}</h4>
        <p class="card-description">{{ __('Garanta a integridade da sua conta usando uma senha longa e segura.') }}</p>
    </div>
    <div class="card-body">

        <x-maz-alert color="success" on="saved">
            {{ __('Atualizado.') }}
        </x-maz-alert>
        <form wire:submit.prevent="updatePassword">

            <div class="form-group">
                <label for="current_password">{{ __('Senha Atual') }}</label>
                <input id="current_password" type="password"  class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}" name="current_password" wire:model.defer="state.current_password" autocomplete="current-password" >
                <x-maz-input-error for="current_password" />
            </div>

            <div class="form-group">
                <label for="password">{{ __('Nova Senha') }}</label>
                <input id="password" type="password"  class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" wire:model.defer="state.password" autocomplete="new-password" >
                <x-maz-input-error for="password" />
            </div>

            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirmar Senha') }}</label>
                <input id="password_confirmation" type="password"  class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password" wire:model.defer="state.password_confirmation" autocomplete="new-password" >
                <x-maz-input-error for="password_confirmation" />
            </div>

            <button class="btn bg-orange float-end mt-2"  wire:loading.attr="disabled" wire:target="updatePassword">{{ __('Atualizar') }}</button>
        </form>

    </div>



</div>
