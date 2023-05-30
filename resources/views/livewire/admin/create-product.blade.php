<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    
    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>

    <div class="grid grid-cols-2 gap-6 mb-4">

        {{-- Categoría --}}
        <div>
            <x-label value="Categorías" />
            <select class="w-full form-control" wire:model="category_id">
                <option value="" selected disabled>Seleccione una categoría</option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <x-input-error for="category_id" />
        </div>

        {{-- Subcategoría --}}
        <div>
            <x-label value="Subcategorías" />
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" selected disabled>Seleccione una subcategoría</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>

            <x-input-error for="subcategory_id" />
        </div>
    </div>

    {{-- Nombre --}}
    <div class="mb-4">
        <x-label value="Nombre" />
        <x-input type="text" 
                    class="w-full"
                    wire:model="name"
                    placeholder="Ingrese el nombre del producto" />
        <x-input-error for="name" />
    </div>

    {{-- Slug --}}
    <div class="mb-4">
        <x-label value="Slug" />
        <x-input type="text"
            disabled
            wire:model="slug"
            class="w-full bg-gray-200" 
            placeholder="Ingrese el slug del producto" />

    <x-input-error for="slug" />
    </div>

    {{-- Descrición --}}
    <div class="mb-4">
        <div wire:ignore>
            <x-label value="Descripción" />
            <textarea class="w-full form-control" rows="4"
                wire:model="description"
                x-data 
                x-init="ClassicEditor.create($refs.miEditor)
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );"
                x-ref="miEditor">
            </textarea>
        </div>
        <x-input-error for="description" />
    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Marca --}}
        <div>
            <x-label value="Marca" />
            <select class="form-control w-full" wire:model="brand_id">
                <option value="" selected disabled>Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>

            <x-input-error for="brand_id" />
        </div>

        {{-- Precio --}}
        <div>
            <x-label value="Precio" />
            <x-input 
                wire:model="price"
                type="number" 
                class="w-full" 
                step=".01" />
            <x-input-error for="price" />
        </div>
    </div>

    @if ($subcategory_id)
        
        @if (!$this->subcategory->platform && !$this->subcategory->edition)
            
            <div>
                <x-label value="Cantidad" />
                <x-input 
                    wire:model="quantity"
                    type="number" 
                    class="w-full" />
                <x-input-error for="quantity" />
            </div>

        @endif

    @endif


    <div class="flex mt-4">
        <x-button
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save"
            class="ml-auto">
            Crear producto
        </x-button>
    </div>

</div>