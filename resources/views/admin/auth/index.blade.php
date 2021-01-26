@extends('admin.layouts.auth')
@section('content')

<div class="nk-block nk-block-middle nk-auth-body  wide-xs">
    <div class="brand-logo pb-4 text-center">
        <a href="html/index.html" class="logo-link">
            <img class="logo-light logo-img logo-img-lg" src="{{ asset('admin/assets/images/logo.png') }}" srcset="{{ asset('admin/assets/images/logo2x.png 2x') }}" alt="logo">
            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('admin/assets/images/logo-dark.png') }}" srcset="{{ asset('admin/assets/images/logo-dark2x.png 2x') }}" alt="logo-dark">
        </a>
    </div>
    <div class="card card-bordered mb-5">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Sign-In</h4>
                    <div class="nk-block-des">
                        <p>Access the Dashboard panel using your email and passcode.</p>
                    </div>
                </div>
            </div>
            <form action="html/index.html">
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="default-01">Email or Username</label>
                    </div>
                    <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password">Password</label>
                        <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Password?</a>
                    </div>
                    <div class="form-control-wrap">
                        <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection