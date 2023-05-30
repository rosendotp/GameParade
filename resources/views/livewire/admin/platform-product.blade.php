<div class="mt-4">
    <div class="bg-gray-100 shadow-lg rounded-lg p-6">


        {{-- Color --}}
        <div class="mb-6">
            <x-label>
                Plataforma
            </x-label>

            <div class="grid grid-cols-6 gap-6">
                @foreach ($platforms as $platform)
                    <label>
                        <input type="radio" name="platform_id" wire:model.defer="platform_id" value="{{ $platform->id }}">
                        <span class="ml-2 text-gray-700 capitalize">
                            {{ __($platform->name) }}
                        </span>
                    </label>
                @endforeach
            </div>

            <x-input-error for="platform_id" />
        </div>

        {{-- Cantidad --}}
        <div>

            <x-label>
                Cantidad
            </x-label>

            <x-input type="number" wire:model.defer="quantity" placeholder="Ingrese una cantidad" class="w-full" />

            <x-input-error for="quantity" />

        </div>

        <div class="flex justify-end items-center mt-4">

            <x-action-message class="mr-3" on="saved">
                Agregado
            </x-action-message>

            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                Agregar
            </x-button>
        </div>

    </div>

    @if ($edition_platforms->count())
        
        <div class="mt-8">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">
                            Plataformas
                        </th>

                        <th class="px-4 py-2 w-1/3">
                            Cantidad
                        </th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($edition_platforms as $edition_platform)
                        <tr wire:key="edition_platform-{{ $edition_platform->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($platforms->find($edition_platform->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $edition_platform->pivot->quantity }} unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-secondary-button class="ml-auto mr-2"
                                    wire:click="edit({{ $edition_platform->pivot->id }})" wire:loading.attr="disabled"
                                    wire:target="edit({{ $edition_platform->pivot->id }})">
                                    Actualizar
                                </x-secondary-button>

                                <x-danger-button
                                    wire:click="$emit('deleteEditionPlatform', {{ $edition_platform->pivot->id }})">
                                    Eliminar
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif

    <x-dialog-modal wire:model="open" wire:key="modal-edition-product-{{$edition->id}}">

        <x-slot name="title">
            Editar plataforma
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label>
                    Plataforma
                </x-label>

                <select class="form-control w-full" wire:model="pivot_color_id">
                    <option value="">Seleccione una plataforma</option>
                    @foreach ($platforms as $platform)
                        <option value="{{ $platform->id }}">{{ ucfirst(__($platform->name)) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-label>
                    Cantidad
                </x-label>
                <x-input class="w-full" wire:model="pivot_quantity" type="number"
                    placeholder="Ingrese una cantidad" />
            </div>
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