<div>

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>
    
                <div class="flex">
                    <a class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-4" href="{{route('admin.index')}}">
                        <i class="fas fa-arrow-left mr-2"></i> Volver
                    </a>
    
                    <x-danger-button wire:click="$emit('deleteProduct')">
                        Eliminar
                    </x-danger-button>
                </div>
            </div>
        </div>
    </header>
    
    

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

        <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>

        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.products.files', $product) }}" method="POST" class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>

        @if ($product->images->count())

            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del producto</h1>

                <ul class="flex flex-wrap">
                    @foreach ($product->images as $image)

                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                            <x-danger-button class="absolute right-2 top-2"
                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                wire:target="deleteImage({{ $image->id }})">
                                x
                            </x-danger-button>
                        </li>

                    @endforeach

                </ul>
            </section>

        @endif


        @livewire('admin.status-product', ['product' => $product], key('status-product-' . $product->id))

        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-2 gap-6 mb-4">

                {{-- Categoría --}}
                <div>
                    <x-label value="Categorías" />
                    <select class="w-full form-control" wire:model="category_id">
                        <option value="" selected disabled>Seleccione una categoría</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error for="category_id" />
                </div>

                {{-- Subcategoría --}}
                <div>
                    <x-label value="Subcategorías" />
                    <select class="w-full form-control" wire:model="product.subcategory_id">
                        <option value="" selected disabled>Seleccione una subcategoría</option>

                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error for="product.subcategory_id" />
                </div>
            </div>

            {{-- Nombre --}}
            <div class="mb-4">
                <x-label value="Nombre" />
                <x-input type="text" class="w-full" wire:model="product.name"
                    placeholder="Ingrese el nombre del producto" />
                <x-input-error for="product.name" />
            </div>

            {{-- Slug --}}
            <div class="mb-4">
                <x-label value="Slug" />
                <x-input type="text" disabled wire:model="slug" class="w-full bg-gray-200"
                    placeholder="Ingrese el slug del producto" />

                <x-input-error for="slug" />
            </div>

            {{-- Descripción --}}
            <div class="mb-4">
                <div wire:ignore>
                    <x-label value="Descripción" />
                    <textarea class="w-full form-control" rows="4" wire:model="product.description" x-data x-init="ClassicEditor.create($refs.miEditor)
                        .then(function(editor){
                            editor.model.document.on('change:data', () => {
                                @this.set('product.description', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );" x-ref="miEditor">
                    </textarea>
                </div>
                <x-input-error for="product.description" />
            </div>

            <div class="grid grid-cols-2 gap-6 mb-4">
                {{-- Marca --}}
                <div>
                    <x-label value="Marca" />
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error for="product.brand_id" />
                </div>

                {{-- Precio --}}
                <div>
                    <x-label value="Precio" />
                    <x-input wire:model="product.price" type="number" class="w-full" step=".01" />
                    <x-input-error for="product.price" />
                </div>
            </div>


            @if ($this->subcategory)


            @if (!$this->subcategory->platform && !$this->subcategory->edition)

                    <div>
                        <x-label value="Cantidad" />
                        <x-input wire:model="product.quantity" type="number" class="w-full" />
                        <x-input-error for="product.quantity" />
                    </div>

                @endif

            @endif

            <div class="flex justify-end items-center mt-4">

                <x-action-message class="mr-3" on="saved">
                    Actualizado
                </x-action-message>

                <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                    Actualizar producto
                </x-button>
            </div>
        </div>


        @if ($this->subcategory)

            @if ($this->subcategory->edition)

                @livewire('admin.edition-product', ['product' => $product], key('edition-product-' . $product->id))

            @elseif($this->subcategory->platform)

                @livewire('admin.platform-product', ['product' => $product], key('platform-product-' . $product->id))

            @endif

        @endif


    </div>


    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro",
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshProduct');
                }
            };


            Livewire.on('deleteProduct', () => {

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

                        Livewire.emitTo('admin.edit-product', 'delete');

                        Swal.fire(
                            'Borrado',
                            'Tu registro ha sido borrado.',
                            'success'
                        )
                    }
                })

            })

            Livewire.on('deleteEdition', editionId => {

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

                        Livewire.emitTo('admin.edition-product', 'delete', editionId);

                        Swal.fire(
                            'Borrado',
                            'Tu registro ha sido borrado.',
                            'success'
                        )
                    }
                })

            })

            Livewire.on('deletePivot', pivot => {
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

                        Livewire.emitTo('admin.platform-product', 'delete', pivot);

                        Swal.fire(
                            'Borrado',
                            'Tu registro ha sido borrado.',
                            'success'
                        )
                    }
                })
            })

            Livewire.on('deleteEditionPlatform', pivot => {
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

                        Livewire.emitTo('admin.edition-platform', 'delete', pivot);

                        Swal.fire(
                            'Borrado',
                            'Tu registro ha sido borrado.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush

</div>