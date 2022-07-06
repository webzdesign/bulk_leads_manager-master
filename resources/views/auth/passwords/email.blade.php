@extends('layouts.master')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <section class="loginBanner w-100">
        <img src="{{ asset('public/assets/images/login-banner.png') }}" alt="login" class="w-100">
    </section>

    <section class="loginCard d-flex align-items-center justify-content-center">
        <div class="bg-white loginCardBody w-100-500">
            <div class="loginCardHead d-flex align-items-center justify-content-center position-relative">
                <h3 class="text-white f-700 f-22 m-0">Forgot Password</h3>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" id="form">
                @csrf
                <div class="form-group">
                    <label for="email" class="c-gr f-500 f-12 mb-2 d-flex align-items-center">
                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.6666 5.16683L6.99996 8.0835L2.33329 5.16683V4.00016L6.99996 6.91683L11.6666 4.00016V5.16683ZM11.6666 2.8335H2.33329C1.68579 2.8335 1.16663 3.35266 1.16663 4.00016V11.0002C1.16663 11.3096 1.28954 11.6063 1.50833 11.8251C1.72713 12.0439 2.02387 12.1668 2.33329 12.1668H11.6666C11.976 12.1668 12.2728 12.0439 12.4916 11.8251C12.7104 11.6063 12.8333 11.3096 12.8333 11.0002V4.00016C12.8333 3.35266 12.3083 2.8335 11.6666 2.8335Z"
                                fill="#4F4F52" />
                        </svg>
                        Email Address
                    </label>
                    <input type="text" id="email" name="email" class="form-control f-400 f-14 text-dark" value="{{ old('email') }}" placeholder="Enter your email address" autofocus>

                    @error('email')
                        <span class="text-danger f-400 f-14">
                            {{ $message }}
                        </span>
                    @enderror
                    {{-- <span class="text-danger f-400 f-14">Email is require</span> --}}
                </div>
                <button type="submit" class="btn-primary text-uppercase w-100 mt-4">Reset password</button>
            </form>
        </div>
    </section>
@endsection
@section('script')

<script>
     $(document).ready(function () {
        $("#form").validate({
            rules:{
                email: {
                    email: true,
                    required: true
                },
            },
            messages:{
                email:{
                    required: "Email Is Required."
                },
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger f-400 f-14').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });
    });
</script>

@endsection
