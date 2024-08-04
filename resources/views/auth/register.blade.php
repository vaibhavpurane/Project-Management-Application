@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="registerform" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                <span class="error-message text-danger"></span>
                                @error('name')
                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span class="error-message text-danger"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                <span class="error-message text-danger"></span>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="error-message text-danger"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='module'>
// $(document).ready(function () {
//     $('.submit').click(function (e) {   
//         $('.error-message').text('');
//         var isValid = true;
//         var name = $('#name').val().trim();
//         if(name === ''){
//             $('#name').siblings('.error-message').text('Please enter your name');
//             isValid=false;
//         }
//         var email=$('#email').val().trim();
//         if(email === ''){
//             $('#email').siblings('.error-message').text('Please enter your email address');
//             isValid=false;
//         }else if(!isValidEmail(email)){
//             $('#email').siblings('.error-message').text('Please, enter valid email address');
//             isValid=false;
//         }
//         var phone = $('#phone').val();
//         if(phone === ''){
//             $('#phone').siblings('.error-message').text('Please enter your phone');
//             isValid=false;
//         }else if(!isValidPhone(phone)){
//             $('#phone').siblings('.error-message').text('Please, enter your valid phone');
//             isValid=false;
//         }
//         var password = $('#password').val();
//         if (password === '') {
//             $('#password').siblings('.error-message').text('Please enter your password');
//             isValid = false;
//         }else if(!isValidPassword(password)){
//             $('#password').siblings('.error-message').text('Your password must be at least 8 characters long');
//             isValid = false;
//         }
//         var passwordConfirm = $('#password-confirm').val();
//         if (password !== passwordConfirm) {
//             $('#password-confirm').siblings('.error-message').text('Password confirmation must match the password');
//             isValid = false;
//         }

//         if(!isValid){
//             e.preventDefault();
//         } 
//     })
//     function isValidEmail(email){
//         var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         return emailPattern.test(email);
//     }
//     function isValidPhone(phone){
//         var phonePattern = /^[0-9]{10}$/;
//         return phonePattern.test(phone);
//     }
//     function isValidPassword(password){
//         var passwordPattern = /^.{8}$/;
//         return passwordPattern.test(password);
//     }
// })
</script>

@endsection
