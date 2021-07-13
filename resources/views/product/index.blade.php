<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-start mb-3">
                        <a class="text-gray-600 hover:text-gray-900 btn btn-primary" href="{{ route('product.create') }}">
                            {{ __('Create New Product') }}
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                @if(isset($product->image))
                                    <td><img height="50px" width="50px" src="{{ asset('storage/'.$product->image) }}"></td>
                                @else
                                    <td></td>
                                @endif

                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->sale_price }}</td>
                                <td><div class="row">
                                        <a style="color: #ff0000" class="ml-4" href="{{ route('product.edit', ['product' => $product]) }}"><span class="fa fa-edit"></span></a>
                                        <form id="{{ 'delete_'.$product->id }}" action="{{ route('product.destroy',['product' => $product]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a style="cursor: pointer; color: #ff0000" onclick="document.getElementById('{{ 'delete_'.$product->id }}').submit()"><span class="fa fa-trash ml-3"></span></a>
                                        </form>
                                    </div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
