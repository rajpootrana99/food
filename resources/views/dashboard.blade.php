<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        @foreach($orders as $order)
                            <div class="col-2 mb-2">
                                <div class="card">
                                    <div class="card-header text-center">Table # {{ $order->table }}</div>
                                    <div class="card-body text-center">
                                        <p>Invoice # {{ $order->id }}</p>
                                        <?php $total = 0; ?>
                                        @foreach($order->products as $product)
                                            <?php $total += $product->sale_price*$product->pivot->qty ?>
                                        @endforeach
                                        <p>Total Bill = {{ $total }}</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('order.edit', ['order' => $order]) }}" class="btn btn-primary">Edit</a>
                                            </div>
                                            <div class="col-6">
                                                <form id="{{ 'post_'.$order->id }}" method="post" action="{{ route('order.update', ['order' => $order]) }}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <a onclick="document.getElementById('{{ 'post_'.$order->id }}').submit()" class="btn btn-primary">Post</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

</script>
