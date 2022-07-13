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
                <form id="form-create" data-action="{{ route('store-product-gallery', $productId) }}" data-page-url="{{ route('product-galleries', $productId) }}">
                    <input type="hidden" name="product_id" value="{{$productId}}">
                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control" type="file" name="image">
                        <p class="help-block help-block-image"></p>
                    </div>

                    <div class="form-group">
                        <label>Gambar Utama</label>
                        <input class="" type="checkbox" name="cover">
                        <p class="help-block help-block-cover"></p>
                    </div>

                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-icon-split kembali">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        @can('create_product_gallery')
                        <button type="submit" class="btn btn-sm btn-primary btn-icon-split simpan-data">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
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
    let pageUrl = jQuery('#form-create').data('page-url');

    let url = jQuery('#form-create').data('action');


    jQuery('#form-create').on('submit', function(e) {

        e.preventDefault();

        let data = new FormData(this);

        jQuery.ajax({
            'headers': {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'method': 'POST',
            'enctype': 'multipart/form-data',
            'dataType': 'json',
            'cache': false,
            'contentType': false,
            'processData': false,
            'data': data,
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
                console.log(response);
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