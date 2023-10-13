<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ __('Deletar Conta') }}</h4>
        <p class="card-description">
            {{ __('Sua conta será permanentemente deletada do sistema.') }}
        </p>
    </div>
    <div class="card-body">
        <p>{{ __('Uma vez que sua conta for deletada, Todas as suas informações serão permanentemente deletadas e a ação não pode ser desfeita.') }}</p>
        <div class="mt-5">
            <button class="btn btn-danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Deletar conta') }}
            </button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Deletar Conta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Você tem certeza que quer deletar sua conta? Seus dados serão permanentemente deletados. Entre com sua senha para confirmar que você quer deletar permanentemente a sua conta.') }}

                <div class="mt-4" x-data="{}"
                     x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('Senha') }}"
                           x-ref="password"
                           wire:model.defer="password"
                           wire:keydown.enter="deleteUser"/>

                    <x-maz-input-error for="password" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class='btn btn-outline-secondary' wire:click="$toggle('confirmingUserDeletion')"
                        wire:loading.attr="disabled">
                    {{ __('Esquecer') }}
                </button>

                <button class="btn btn-danger" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Deletar Conta') }}
                </button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
