<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-9">
                <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Invoice') }}
                </h2>
            </div>
            <div class="col-3">
                <form id="search_product" method="GET" action="{{ route('order.search') }}">
                    <div class="row ml-1">
                        <input type="text" class="col-7" onchange="document.getElementById('{{ 'search_product' }}').submit()" placeholder="Search Product" name="search_name">
                        <input type="submit" class="btn btn-primary col-3 ml-2" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class="card">
                        <div class="row">
                            <div class="card-body col-8">
                                <div class="row">
                                    @foreach($categories as $category)
                                        <a href="{{ route('order.filter', ['category' => $category->category_name]) }}" class="btn btn-primary ml-3 mb-2">{{ $category->category_name }}</a>
                                    @endforeach
                                        <a href="{{ route('order.filter', ['category' => 'all']) }}" class="btn btn-primary ml-3 mb-2">all</a>
                                </div>
                                <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-3">
                                        <div class="card" href="#add_to_cart" data-product="{{ $product->id }}" data-toggle="modal">
                                            <div style="height: 70px" class="card-header">
                                                <img style="height: 100%; width: 100%; object-fit: contain" src="{{ asset('storage/'.$product->image) }}">
                                            </div>
                                            <div class="card-body" style="height: 80px; font-size: small">
                                                <p><strong>{{ $product->name }}</strong></p>
                                                <p><strong>Price : </strong>{{ $product->sale_price }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(isset($order))
                            <div class="col-3 mt-2 mb-2">
                                <h4 class="text-center"><strong>Cart</strong></h4>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0; ?>
                                        @foreach($order->products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->pivot->qty }}</td>
                                                <td>{{ $product->sale_price*$product->pivot->qty }}</td>
                                                <td>
                                                    <div class="row">
                                                        <form id="{{ 'delete_'.$product->id }}" action="{{ route('cart.destroy',['product' => $product]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <a style="cursor: pointer; color: #ff0000" onclick="document.getElementById('{{ 'delete_'.$product->id }}').submit()"><span class="fa fa-trash ml-3"></span></a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $total += $product->sale_price*$product->pivot->qty ?>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td>{{ $total }}</td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <form class="float-right" method="post" action="{{ route('cart.update') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <select name="order_type" class="mb-2 float-left" id="order_type" onchange="ShowHideDiv()">
                                            <option value="0"{{ $order->order_type == 'Takeaway' ? 'selected' : ''}}>Takeaway</option>
                                            <option value="1"{{ $order->order_type == 'Dine-In' ? 'selected' : ''}}>Dine-In</option>
                                        </select>
                                        <input type="number" placeholder="Table Number" class="mb-2 float-left" value="{{ $order->table ?? old('table') }}" name="table" id="table" style="display: none;">
                                        <input type="submit" value="Proceed to Checkout" class="btn btn-primary">
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_to_cart" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('order.store') }}">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12 col-sm-12">
                                @if(isset($order->id))
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                @endif
                                <div class="form-group">
                                    <label>Quntity</label>
                                    <input type="hidden" id="product_id" name="product_id">
                                    <input type="number" name="qty" class="form-control">
                                    <div style="color: #ff0000; font-size: small;" class="mt-2">{{ $errors->first('qty') }}</div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $('#add_to_cart').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var product_id = button.data('product')
        var modal = $(this)
        modal.find('.modal-body #product_id').val(product_id);
    })

    function ShowHideDiv() {
        var order_type = document.getElementById("order_type");
        var table = document.getElementById("table");
        table.style.display = order_type.value == 1 ? "block" : "none";
    }
</script>
