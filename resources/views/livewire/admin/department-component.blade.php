<div class="container py-12">
    {{-- Agregar tienda --}}
    <x-form-section submit="save" class="mb-6">

        <x-slot name="title">
            Agregar un nueva Tienda
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder agregar una nueva tienda 
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
                Tienda agregada
            </x-action-message>

            <x-button>
                Agregar
            </x-button>
        </x-slot>
    </x-form-section>

    {{-- Mostrar Tiendas --}}
    <x-action-section>
        <x-slot name="title">
            Lista de Tiendas
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas los tiendas agregadas
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
                    @foreach ($departments as $department)
                        <tr>
                            <td class="py-2">

                                <a href="{{route('admin.departments.show', $department)}}" class="uppercase underline hover:text-blue-600">
                                    {{$department->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$department}})">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteDepartment', {{$department->id}})">Eliminar</a>
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
            Editar tienda
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

    @push('script')
        <script>
            Livewire.on('deleteDepartment', departmentId => {
            
                Swal.fire({
                    title: 'Estás seguro ?',
                    text: "No podrás recuperar este registro! ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Borrar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.department-component', 'delete', departmentId)

                        Swal.fire(                                        
                            'Borrado!',
                            'Tu registro ha sido borrado',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>
