<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">

        <div class="order-2 lg:order-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase"><span class="font-semibold">Número de factura:</span>
                    Factura-{{ $invoice->id }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-semibold uppercase">Envío</p>

                        @if ($invoice->envio_type == 1)
                            <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p class="text-sm">Calle falsa 123</p>
                        @else
                            <p class="text-sm">Los productos Serán enviados a:</p>
                            <p class="text-sm">{{ $envio->address }}</p>
                            <p>{{ $envio->department }} - {{ $envio->town }} - {{ $envio->street }}
                            </p>
                        @endif


                    </div>

                    <div>
                        <p class="text-lg font-semibold uppercase">Datos de contacto</p>

                        <p class="text-sm">Persona que recibirá el producto: {{ $invoice->contact }}</p>
                        <p class="text-sm">Teléfono de contacto: {{ $invoice->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                <p class="text-xl font-semibold mb-4">Resumen</p>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                            alt="">
                                        <article>
                                            <h1 class="font-bold">{{ $item->name }}</h1>
                                            <div class="flex text-xs">

                                                @isset($item->options->platform)
                                                Plataforma: {{ __($item->options->platform) }}
                                                @endisset

                                                @isset($item->options->edition)
                                                    - {{ $item->options->edition}}
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>

                                <td class="text-center">
                                    {{ $item->price }} €
                                </td>

                                <td class="text-center">
                                    {{ $item->qty }}
                                </td>

                                <td class="text-center">
                                    {{ $item->price * $item->qty }} €
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>

        <div class="order-1 lg:order-2 xl:col-span-2">
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                <div class="flex justify-between items-center mb-4">
                    <img class="h-8" src="{{ asset('img/MC_VI_DI_2-1.jpg') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: {{ $invoice->total - $order->shipping_cost }} €
                        </p>
                        <p class="text-sm font-semibold">
                            Envío: {{ $invoice->shipping_cost }} €
                        </p>
                        <p class="text-lg font-semibold uppercase">
                            Total: {{ $invoice->total }} €
                        </p>

                        <div class="cho-container">

                        </div>
                    </div>
                </div>


                <div id="paypal-button-container"></div>

            </div>
        </div>

    </div>


    @push('script')
        
    

        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}">
            // Replace YOUR_CLIENT_ID with your sandbox client ID

        </script>


        <script>
            paypal.Buttons({
                createInvoice: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "{{ $invoice->total }}"
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {

                        Livewire.emit('payInvoice');

                        /* console.log(details);

                        alert('Transaction completed by ' + details.payer.name.given_name); */
                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page

        </script>

    @endpush
</div>
