@extends('admin.layouts.app')

@push('addon-style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet">
</link>
<style>
    .help-block {
        font-style: italic;
        color: red;
    }
</style>
@endpush

@section('title')
{{ $title }}
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">{{ $title }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form id="form-update" data-action="{{ route('update-product', $product->id) }}" data-page-url="{{ route('products') }}">
                    <div class="form-group">
                        <label>Nama Product</label>
                        <input class="form-control product-name" type="text" name="product_name" onkeyup="typeSlug(this)" value="{{$product->product_name}}" autocomplete="off">
                        <p class="help-block help-block-product_name"></p>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input class="form-control" type="text" name="slug" value="{{$product->slug}}" autocomplete="off" readonly>
                        <p class="help-block help-block-slug"></p>
                    </div>

                    <div class="form-group">
                        <label>Mitra</label>
                        <input class="form-control" type="text" name="owner" value="{{$product->owner}}" autocomplete="off">
                        <p class="help-block help-block-owner"></p>
                    </div>

                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-icon-split kembali">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        @can('update_product')
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-icon-split simpan-data">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </a>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')
<script>
    let pageUrl = jQuery('#form-update').data('page-url');

    jQuery('.simpan-data').on('click', function() {
        let url = jQuery('#form-update').data('action');

        jQuery.ajax({
            'headers': {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'method': 'POST',
            'dataType': 'json',
            'cache': false,
            'data': {
                '_method': 'PUT',
                'product_name': jQuery('input[name=product_name]').val(),
                'slug': jQuery('input[name=slug]').val(),
                'owner': jQuery('input[name=owner]').val()
            },
            success: function(response) {
                if (response.status) {

                    console.log(response.data);

                    tata.success('Sukses simpan data', '', {
                        position: 'tr'
                    });
                    jQuery('.help-block').html('');

                    setTimeout(() => {
                        window.location.href = pageUrl;
                    }, 4000);
                } else {
                    console.log(response);
                    tata.error('Gagal simpan data, hubungi admin', '', {
                        position: 'tr'
                    });
                }
            },
            error: function(response) {
                if (response.responseJSON !== undefined) {

                    jQuery('.help-block').html('');

                    let data = response.responseJSON.errors;
                    for (let key in data) {
                        jQuery('.help-block-' + key).html(`${data[key]}`);
                    }
                }

            }
        })
    });

    jQuery('.kembali').on('click', function() {
        window.location.href = pageUrl;
    })
</script>

@endpush