<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">

    <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-label value="Nombre de contácto" />
                <x-input type="text"
                            wire:model.defer="contact"
                            placeholder="Ingrese el nombre de la persona que recibirá el producto"
                            class="w-full"/>
                <x-input-error for="contact" />
            </div>

            <div>
                <x-label value="Teléfono de contacto" />
                <x-input type="text"
                            wire:model.defer="phone"
                            placeholder="Ingrese un número de telefono de contácto"
                            class="w-full"/>

                <x-input-error for="phone" />
            </div>
        </div>

        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Recojo en tienda (Calle Falsa 777)
                </span>

                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center cursor-pointer">
                    <input x-model="envio_type"  type="radio" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envío a domicilio
                    </span>

                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">

                    {{-- Departamentos --}}
                    <div>
                        <x-label value="Tienda" />

                        <select class="form-control w-full" wire:model="department_id">

                            <option value="" disabled selected>Seleccione una tienda</option>

                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>

                        <x-input-error for="department_id" />
                    </div>

                    {{-- Ciudades --}}
                    <div>
                        <x-label value="Ciudad" />

                        <select class="form-control w-full" wire:model="town_id">

                            <option value="" disabled selected>Seleccione una ciudad</option>

                            @foreach ($towns as $town)
                                <option value="{{$town->id}}">{{$town->name}}</option>
                            @endforeach
                        </select>

                        <x-input-error for="town_id" />
                    </div>
                    {{-- Distritos --}}
                    <div>
                        <x-label value="Calle" />

                        <select class="form-control w-full" wire:model="street_id">

                            <option value="" disabled selected>Seleccione una calle</option>

                            @foreach ($streets as $street)
                                <option value="{{$street->id}}">{{$street->name}}</option>
                            @endforeach
                        </select>

                        <x-input-error for="street_id" />
                    </div>
                    <div>
                        <x-label value="Dirección" />
                        <x-input class="w-full" wire:model="address" type="text" />
                        <x-input-error for="address" />
                    </div>

                    <div class="col-span-2">
                        <x-label value="Referencia" />
                        <x-input class="w-full" wire:model="references" type="text" />
                        <x-input-error for="references" />
                    </div>

                </div>
            </div>

        </div>

        <div>
            <x-button
                wire:loading.attr="disabled"
                wire:target="create_invoice"
                class="mt-6 mb-4" 
                wire:click="create_invoice">
                Continuar con la compra
            </x-button>

            <hr>

            <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam atque quo, labore facere placeat illo consequatur hic ut sapiente exercitationem, architecto iure, consequuntur impedit ex iusto ipsa voluptas laudantium iste <a href="" class="font-semibold text-orange-500">Políticas y privacidad</a></p>
        </div>

    </div>

    <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">

                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->name}}</h1>

                            <div class="flex">
                                <p>Cant: {{$item->qty}}</p>
                                @isset($item->options['platform'])
                                    <p class="mx-2">- Plataforma: {{__($item->options['platform'])}}</p>
                                @endisset

                                @isset($item->options['edition'])
                                    <p>{{$item->options['edition']}}</p>
                                @endisset

                            </div>

                            <p>{{$item->price}} €</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{Cart::subtotal()}} €</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            {{$shipping_cost}} €
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type == 1)
                        {{Cart::subtotal()}} €
                    @else
                        {{Cart::subtotal() + $shipping_cost}} €
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>