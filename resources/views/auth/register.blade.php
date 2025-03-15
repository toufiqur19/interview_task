@extends('auth.app')
@section('content')
    <div class="container">
        <div class="card_body">
            <form id="registerForm" class="form">
                <h2 class="title">Register Form</h2>
                <div class="mb-1">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                    <span class="text-danger" id="first_name_error"></span>
                </div>
                <div class="mb-1">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                    <span class="text-danger" id="last_name_error"></span>
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <span class="text-danger" id="email_error"></span>
                </div>
                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="text-danger" id="password_error"></span>
                </div>
                <div class="mb-2">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirm_password" class="form-control">
                    <span class="text-danger" id="confirm_password_error"></span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <p class="mt-2">Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#registerForm').submit(function(e) {
                e.preventDefault();

                // form validation
                if ($('#first_name').val() == '') {
                    $('#first_name_error').text('First name is required');
                    return;
                } else if ($('#last_name').val() == '') {
                    $('#last_name_error').text('Last name is required');
                    return;
                } else if ($('#email').val() == '') {
                    $('#email_error').text('Email is required');
                    return;
                } else if ($('#password').val() == '' ) {
                    $('#password_error').text('Password is required');
                    return;
                } else if ($('#password').val().length < 8) {
                    $('#password_error').text('Password must be at least 8 characters');
                    return;
                }else if ($('#confirm_password').val() == '') {
                    $('#confirm_password_error').text('Confirm password is required');
                    return;
                }else if ($('#password').val().length < 8) {
                    $('#password_error').text('Password must be at least 8 characters');
                    return;
                }else if ($('#password').val() != $('#confirm_password').val()) {
                    $('#confirm_password_error').text('Confirm password must match password');
                    return;
                }

                $.ajax({
                    url: '/api/register',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        window.location.href = '/login';
                        successToast(response.message);
                    },
                    error: function(xhr, status, error) {
                        errorToast('Registration failed.');
                    }
                });
            });
        })
    </script>
@endpush
