@extends('admin.layouts.auth')

@push('addon-style')
<style>
    .help-block {
        font-size: 12px;
        color: crimson;
        font-style: italic;
    }
</style>
@endpush

@section('title')
Login
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6 d-none d-lg-block"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <p class="help-block help-block-message"></p>
            <form id="formLogin" class="user" data-route="{{ route('auth') }}">
                <!-- @csrf -->
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    <p class="help-block help-block-email"></p>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="inputPassword" placeholder="Password">
                    <p class="help-block help-block-password"></p>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                    </div>
                </div>
                <a href="javascript:void(0)" class="btn btn-primary btn-user btn-block btn-login">
                    Login
                </a>
                <!-- <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button> -->
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="register.html">Create an Account!</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')
<script>
    let url = jQuery("#formLogin").data('route');

    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            login();
        }
    });

    jQuery('.btn-login').on('click', login);

    function login() {

        jQuery(".btn-login").html('Autentifikasi...');

        jQuery.ajax({
            'headers': {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'method': 'POST',
            'dataType': 'json',
            'cache': false,
            'data': {
                'email': jQuery('#inputEmail').val(),
                'password': jQuery('#inputPassword').val(),
                'rememberme': jQuery('#customCheck').is(':checked'),
            },
            'success': function(response) {

                jQuery(".btn-login").html('Login');

                jQuery('.help-block').html('');
                if (response.status) {
                    window.location.href = "admin/dashboard";
                }
                jQuery('.help-block-message').html(response.message);
            },
            'error': function(response) {

                jQuery(".btn-login").html('Login');

                if (response.responseJSON !== undefined) {
                    jQuery('.help-block').html('');
                    let data = response.responseJSON.errors;
                    for (let key in data) {
                        jQuery('.help-block-' + key).html(`${data[key]}`);
                    }
                }

            }
        })
    }
</script>
@endpush