@extends('layouts.master')
@section('content')
    <section class="loginBanner w-100">
        <img src="{{ asset('assets/images/login-banner.png') }}" alt="login" class="w-100">
    </section>

    <section class="loginCard d-flex align-items-center justify-content-center">
        <div class="bg-white loginCardBody w-100-500">
            <div class="loginCardHead d-flex align-items-center justify-content-center position-relative">
                <h3 class="text-white f-700 f-22 m-0">Welcome Back!</h3>
            </div>

            <form method="POST" action="{{ route('login') }}" id="form">
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
                    <input type="text" name="email" id="email" class="form-control f-400 f-14 text-dark" value="{{ old('email', 'admin@leadmanager.com') }}" placeholder="Enter your email address" autofocus>
                    @error('email')
                        <span class="text-danger f-400 f-14">
                            {{ $message }}
                        </span>
                    @enderror
                    {{-- <span class="text-danger f-400 f-14">Email is require</span> --}}
                </div>
                <div class="form-group mb-0">
                    <label class="c-gr f-500 f-12 mb-2 d-flex align-items-center">
                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.00004 10.4168C7.30946 10.4168 7.60621 10.2939 7.825 10.0751C8.04379 9.85633 8.16671 9.55958 8.16671 9.25016C8.16671 8.60266 7.64171 8.0835 7.00004 8.0835C6.69062 8.0835 6.39388 8.20641 6.17508 8.4252C5.95629 8.644 5.83337 8.94074 5.83337 9.25016C5.83337 9.55958 5.95629 9.85633 6.17508 10.0751C6.39388 10.2939 6.69062 10.4168 7.00004 10.4168ZM10.5 5.16683C10.8095 5.16683 11.1062 5.28975 11.325 5.50854C11.5438 5.72733 11.6667 6.02408 11.6667 6.3335V12.1668C11.6667 12.4762 11.5438 12.773 11.325 12.9918C11.1062 13.2106 10.8095 13.3335 10.5 13.3335H3.50004C3.19062 13.3335 2.89388 13.2106 2.67508 12.9918C2.45629 12.773 2.33337 12.4762 2.33337 12.1668V6.3335C2.33337 5.686 2.85837 5.16683 3.50004 5.16683H4.08337V4.00016C4.08337 3.22661 4.39067 2.48475 4.93765 1.93777C5.48463 1.39079 6.22649 1.0835 7.00004 1.0835C7.38306 1.0835 7.76233 1.15894 8.1162 1.30551C8.47007 1.45209 8.7916 1.66693 9.06244 1.93777C9.33327 2.20861 9.54811 2.53014 9.69469 2.884C9.84127 3.23787 9.91671 3.61714 9.91671 4.00016V5.16683H10.5ZM7.00004 2.25016C6.53591 2.25016 6.09079 2.43454 5.7626 2.76273C5.43442 3.09091 5.25004 3.53603 5.25004 4.00016V5.16683H8.75004V4.00016C8.75004 3.53603 8.56567 3.09091 8.23748 2.76273C7.90929 2.43454 7.46417 2.25016 7.00004 2.25016Z"
                                fill="#4F4F52" />
                        </svg>
                        Password
                    </label>
                    <input type="password" name="password" id="password" value="Lead@456" class="form-control f-400 f-14 text-dark" placeholder="Enter your password">
                    @error('password')
                        <span class="text-danger f-400 f-14">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="text-end mt-2">
                     <a href="{{ route('password.request') }}" class="c-7b f-12 f-500">Forgot Password?</a>
                </div>
                <button type="submit" class="btn-primary text-uppercase w-100 mt-4">sign in</button>
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
                password: {
                    required: true
                }
            },
            messages:{
                email:{
                    required: "Email Is Required."
                },
                password:{
                    required: "Password Is Required."
                }
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
