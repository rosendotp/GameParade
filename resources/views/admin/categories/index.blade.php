<x-admin-layout>
    
    <div class="container py-12">
        @livewire('admin.create-category')
    </div>

    @push('script')
        <script>
            Livewire.on('deleteCategory', categorySlug => {
            
                Swal.fire({
                    title: '¿Estás seguro de borrar registro?',
                    text: "!No podras volver a recuperarlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar !'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.create-category', 'delete', categorySlug)

                        Swal.fire(
                            'Borrado!',
                            'Su registro ha sido borrado.',
                            'success'
                        )
                    }
                    
                })

            });
        </script>
    @endpush

        </x-admin-layout>