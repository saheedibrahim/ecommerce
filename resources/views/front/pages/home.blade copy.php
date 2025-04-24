@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title')
@section('content')
<div>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-20 md:py-28">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                        <span class="block">Multivendor Marketplace</span>
                        <span class="block text-indigo-200">Shop from multiple vendors</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-indigo-200 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Discover products from thousands of vendors in one place. Quality products, fast delivery, secure payments.
                    </p>
                    <div class="mt-10 max-w-md mx-auto sm:flex sm:justify-center md:mt-12">
                        <div class="rounded-md shadow">
                            <a href="{{ route('shop') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                Shop Now
                            </a>
                        </div>
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                            <a href="{{ route('vendors') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-800 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                Our Vendors
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Shop by Category</h2>
                <a href="{{ route('categories') }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                    Browse all categories<span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4">
                @foreach($categories as $category)
                <div class="group relative">
                    <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-center object-cover">
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-gray-900">
                        <a href="{{ route('category.show', $category) }}">
                            <span class="absolute inset-0"></span>
                            {{ $category->name }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $category->product_count }} products</p>
                </div>
                @endforeach
            </div>

            <div class="mt-6 sm:hidden">
                <a href="{{ route('categories') }}" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                    Browse all categories<span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Featured Products</h2>
                <a href="{{ route('shop') }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                    View all products<span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                @foreach($featuredProducts as $product)
                <div class="group relative">
                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <img src="{{ $product->featured_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="{{ route('product.show', $product) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $product->vendor->name }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="mt-2">
                        <button wire:click="addToCart({{ $product->id }})" class="w-full bg-indigo-600 border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add to cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 sm:hidden">
                {{-- <a href="{{ route('shop') }}" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500"> --}}
                    View all products<span aria-hidden="true"> &rarr;</span>
                {{-- </a> --}}
            </div>
        </div>
    </div>

    <!-- Featured Vendors -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Top Vendors</h2>
                {{-- <a href="{{ route('vendors') }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block"> --}}
                    View all vendors<span aria-hidden="true"> &rarr;</span>
                {{-- </a> --}}
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                @foreach($featuredVendors as $vendor)
                <div class="group relative">
                    <div class="w-full h-80 bg-gray-200 rounded-lg overflow-hidden group-hover:opacity-75">
                        <img src="{{ $vendor->banner_url }}" alt="{{ $vendor->name }}" class="w-full h-full object-center object-cover">
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="{{ $vendor->logo_url }}" alt="{{ $vendor->name }} logo">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                <a href="{{ route('vendor.store', $vendor) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $vendor->name }}
                                </a>
                            </h3>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $vendor->rating)
                                            <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg class="text-gray-300 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <p class="ml-2 text-sm text-gray-500">{{ number_format($vendor->rating, 1) }} ({{ $vendor->reviews_count }} reviews)</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 sm:hidden">
                {{-- <a href="{{ route('vendors') }}" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500"> --}}
                    View all vendors<span aria-hidden="true"> &rarr;</span>
                {{-- </a> --}}
            </div>
        </div>
    </div>

    <!-- Trust Badges -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Why Shop With Us?
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg text-gray-500">
                        Our multivendor marketplace brings together the best vendors across the globe, offering a diverse range of high-quality products with competitive prices.
                    </p>
                    <div class="mt-8 sm:flex">
                        <div class="rounded-md shadow">
                            {{-- <a href="{{ route('register') }}" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"> --}}
                                Create an Account
                            {{-- </a> --}}
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            {{-- <a href="{{ route('become-vendor') }}" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200"> --}}
                                Become a Vendor
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-0.5 md:grid-cols-2 lg:mt-0 lg:gap-8">
                    <div class="col-span-1 flex justify-center py-8 px-8 bg-white rounded-lg">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-base font-medium text-gray-900">Fast Delivery</h3>
                            <p class="mt-1 text-sm text-gray-500">Get your order delivered quickly and efficiently</p>
                        </div>
                    </div>
                    <div class="col-span-1 flex justify-center py-8 px-8 bg-white rounded-lg">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <h3 class="mt-2 text-base font-medium text-gray-900">Secure Payments</h3>
                            <p class="mt-1 text-sm text-gray-500">Your payment information is always protected</p>
                        </div>
                    </div>
                    <div class="col-span-1 flex justify-center py-8 px-8 bg-white rounded-lg">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <h3 class="mt-2 text-base font-medium text-gray-900">Easy Returns</h3>
                            <p class="mt-1 text-sm text-gray-500">Simple return process if you're not satisfied</p>
                        </div>
                    </div>
                    <div class="col-span-1 flex justify-center py-8 px-8 bg-white rounded-lg">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <h3 class="mt-2 text-base font-medium text-gray-900">Quality Guarantee</h3>
                            <p class="mt-1 text-sm text-gray-500">All products vetted for quality standards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection