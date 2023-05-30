<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Ciudad: {{$town->name}}
        </h2>
    </x-slot>

    <div class="container py-12">
        {{-- Agregar distrito --}}
        <x-form-section submit="save" class="mb-6">
    
            <x-slot name="title">
                Agregar una nueva calle
            </x-slot>
    
            <x-slot name="description">
                Complete la información necesaria para poder agregar una nueva calle
            </x-slot>
    
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label>
                        Nombre
                    </x-label>
    
                    <x-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
    
                    <x-input-error for="createForm.name" />
                </div>

            </x-slot>
    
            <x-slot name="actions">
    
                <x-action-message class="mr-3" on="saved">
                    Calle agregada
                </x-action-message>
    
                <x-button>
                    Agregar
                </x-button>
            </x-slot>
        </x-form-section>
    
        {{-- Mostrar Departamentos --}}
        <x-action-section>
            <x-slot name="title">
                Lista de calles
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas las calles agregadas
            </x-slot>
    
            <x-slot name="content">
    
                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>
    
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($streets as $street)
                            <tr>
                                <td class="py-2">
    
                                    {{$street->name}}
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$street}})">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteStreet', {{$street->id}})">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
            </x-slot>
        </x-action-section>
    
        {{-- Modal editar --}}
        <x-dialog-modal wire:model="editForm.open">
    
            <x-slot name="title">
                Editar calle
            </x-slot>
    
            <x-slot name="content">
    
                <div class="space-y-3">
                   
                    <div>
                        <x-label>
                            Nombre
                        </x-label>
    
                        <x-input wire:model="editForm.name" type="text" class="w-full mt-1" />
    
                        <x-input-error for="editForm.name" />
                    </div>
    
                 
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-danger-button>
            </x-slot>
    
        </x-dialog-modal>
    </div>

    @push('script')
        <script>
            Livewire.on('deleteDistrict', streetId => {
            
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás recuperar el registro !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Borrar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.town-component', 'delete', streetId)

                        Swal.fire(
                            'Borrado!',
                            'Tu registro fue borrado.',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>
