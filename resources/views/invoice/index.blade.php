<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="mb-4" method="GET" action="{{ route('invoice.index') }}">
                        <div class="row ml-1">
                            <input type="date" class="col-2" name="start_date">
                            <input type="date" class="col-2 ml-2" name="end_date">
                            <input type="submit" class="btn btn-primary col-2 ml-2" value="Search Invoice">
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th>Product</th>
                            <th>Order Type</th>
                            <th>Table No.</th>
                            <th>Bill Status</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                <?php $total = 0; ?>
                                <td>@foreach($order->products as $product)
                                        <p>{{ $product->name }}</p>
                                        <?php $total += $product->sale_price*$product->pivot->qty ?>
                                    @endforeach</td>
                                <td>{{ $order->order_type }}</td>
                                <td>{{ $order->table }}</td>
                                <td>{{ $order->bill_status }}</td>
                                <td>{{ $total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
