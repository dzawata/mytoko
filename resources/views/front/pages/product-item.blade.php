@extends('front.layouts.app')

@section('title')
{{$title}}
@endsection

@section('content')

<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/'.$product->cover) }}" alt="..." /></div>
            <div class="col-md-6">
                <!-- <div class="small mb-1">SKU: BST-498</div> -->
                <h1 class="display-5 fw-bolder">{{$product->product_name}}</h1>
                <!-- <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">$45.00</span>
                    <span>$40.00</span>
                </div> -->
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                <!-- <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Produk Lainnya</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @forelse($relates as $relate)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset('storage/'.$relate->img) }}" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$relate->product_name}}</h5>
                            <!-- Product price-->
                            <!-- $40.00 - $80.00 -->
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('product-item', $relate->slug) }}">Lihat</a></div>
                    </div>
                </div>
            </div>
            @empty
            <p>Belum ada produk</p>
            @endforelse

        </div>
    </div>
</section>
@endsection