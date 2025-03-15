@extends('auth.app')
@section('content')
    <div class="container">
        <div class="card_body">
            <form id="loginForm" class="form">
                <h2 class="title">Login Form</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <span class="text-danger" id="email_error"></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="text-danger" id="password_error"></span>
                </div>

                <button type="submit" class="btn btn-info">Submit</button>
                <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                // form validation
                if ($('#email').val() == '') {
                    $('#email_error').text('Email is required');
                    return;
                } else if ($('#password').val() == '') {
                    $('#password_error').text('Password is required');
                    return;
                } else if ($('#password').val().length < 8) {
                    $('#password_error').text('Password must be at least 8 characters');
                    return;
                }

                $.ajax({
                    url: '/api/login',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response.token);
                        localStorage.setItem('sanctum_token', response.token);
                        window.location.href = '/users';
                        successToast(response.message);
                    },
                    error: function(xhr, status, error) {
                        errorToast('Login failed.');
                    }
                });
            });
        })
    </script>
@endpush
