<div x-data>
    <div>
        <p class="text-xl text-gray-700">Edicion:</p>

        <select wire:model="edition_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una edicion</option>

            @foreach ($editions as $edition)
                <option value="{{$edition->id}}">{{$edition->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-2">
        <p class="text-xl text-gray-700">Plataforma:</p>

        <select wire:model="platform_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una plataforma: </option>

            @foreach ($platforms as $platform)
                <option class="capitalize" value="{{$platform->id}}">{{ __($platform->name) }}</option>
            @endforeach
        </select>
    </div>

    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">Stock disponible:</span>

        @if ($quantity)
            {{$quantity}}
        @else
            {{$product->stock}}
        @endif

    </p>

    <div class="flex">
        <div class="mr-4">
            <x-secondary-button 
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
                -
            </x-secondary-button>

            <span class="mx-2 text-gray-700">{{$qty}}</span>

            <x-secondary-button 
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
                +
            </x-secondary-button>
        </div>

        <div class="flex-1">
            <x-button 
                x-bind:disabled="!$wire.quantity"
                color="orange" 
                class="w-full"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
</div>
