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
                <form id="form-create-role" data-action="{{ route('store-role') }}" data-page-url="{{ route('roles') }}">
                    <div class="form-group">
                        <label>Role</label>
                        <input class="form-control" type="text" name="role" autocomplete="off">
                        <p class="help-block help-block-role"></p>
                    </div>

                    <div class="form-group">
                        <label>Permissions</label>
                        <select id="permissions" name="permissions" multiple>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <p class="help-block help-block-permissions"></p>
                    </div>

                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-icon-split kembali">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        @can('create_role')
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-icon-split simpan-role">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>
<script>
    let pageUrl = jQuery('#form-create-role').data('page-url');

    const displaySelect = new SlimSelect({
        select: '#permissions'
    })

    jQuery('.simpan-role').on('click', function() {
        let url = jQuery('#form-create-role').data('action');

        jQuery.ajax({
            'headers': {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'method': 'POST',
            'dataType': 'json',
            'cache': false,
            'data': {
                'role': jQuery('input[name=role]').val(),
                'permissions': jQuery('select[name=permissions]').val(),
            },
            success: function(response) {
                if (response.status) {
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