@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title')
@section('content')

<section>
    <div class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        <div class="category-menu">
                            <h3>Category</h3>
                            @if ( count(get_categories()) > 0 )
                                <ul>
                                    @foreach (get_categories() as $category)
                                        <li>
                                            <div class="category-list d-flex">
                                                <img src="/images/categories/{{ $category->category_image }}" width="20rem" height="20rem" alt="">
                                                <h5>
                                                    <a href="">{{ $category->category_name }}</a>
                                                </h5>
                                            </div>
                                        </li>
                                        
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection