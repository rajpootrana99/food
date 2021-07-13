<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EDIT PRODUCT') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->first())
            <div class=" w-full mb-2 mt-6 px-12 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <span style="color: #ff0000">*{{ $errors->first() }}</span>
            </div>
            @endif
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('product.update',['product' => $product]) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @include('product.form')

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Save Product') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


