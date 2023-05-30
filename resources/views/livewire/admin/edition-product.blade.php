<div>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-12">
        <div>
            <x-label>
                Edicion
            </x-label>

            <x-input wire:model="name" type="text" placeholder="Ingrese una edicion" class="w-full" />

            <x-input-error for="name" />
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Agregar
            </x-button>
        </div>
    </div>


    <ul class="mt-12 space-y-4">
        @foreach ($editions as $edition)
            <li class="bg-white shadow-lg rounded-lg p-6" wire:key="edition-{{ $edition->id }}">
                <div class="flex items-center">
                    <span class="text-xl font-medium">{{ $edition->name }}</span>

                    <div class="ml-auto">

                        <x-button wire:click="edit({{ $edition->id }})" wire:loading.attr="disabled"
                            wire:target="edit({{ $edition->id }})">
                            <i class="fas fa-edit"></i>
                        </x-button>

                        <x-danger-button wire:click="$emit('deleteEdition', {{ $edition->id }})">
                            <i class="fas fa-trash"></i>
                        </x-danger-button>

                    </div>
                </div>

                @livewire('admin.edition-platform', ['edition' => $edition], key('edition-platform-' . $edition->id))
            </li>
        @endforeach
    </ul>


    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar edición de producto
        </x-slot>

        <x-slot name="content">
            <x-label>
                Edicion
            </x-label>

            <x-input wire:model="name_edit" type="text" class="w-full" />

            <x-input-error for="name_edit" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
