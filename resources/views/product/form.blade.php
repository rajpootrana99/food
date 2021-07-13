@csrf
<!-- Name -->
<div>
    <x-label for="name" :value="__('Product Name')" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$product->name ?? old('name')" autofocus />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-label for="image" :value="__('Product Image')" />

    <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-label for="category_name" :value="__('Product Category')" />

    <x-input id="category_name" class="block mt-1 w-full" type="text" name="category_name" :value="$product->category_name ?? old('category_name')" />
</div>


<div class="mt-4">
    <x-label for="cost_price" :value="__('Cost Price')" />

    <x-input id="cost_price" class="block mt-1 w-full" type="text" name="cost_price" :value="$product->cost_price ?? old('cost_price')" />
</div>

<div class="mt-4">
    <x-label for="sale_price" :value="__('Sale Price')" />

    <x-input id="sale_price" class="block mt-1 w-full" type="text" name="sale_price" :value="$product->sale_price ?? old('sale_price')" />
</div>
