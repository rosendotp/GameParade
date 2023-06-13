<x-app-layout>
    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{$category->name}}</span> </h1>
                    </h1>                    
                    <a href="{{route('categories.show', $category)}}" class=" mb-2 text-blue-300 hover:text-blue-400 hover:underline ml-2 font-bold">Ver más</a>

                </div>

                @livewire('category-products', ['category' => $category])
            </section>

        @endforeach
    </div>

    
    @push('script')
        
        <script>

            Livewire.on('glider', function(id){

                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },

                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },

                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });

            });
                
        </script>

    @endpush
    
</x-app-layout>