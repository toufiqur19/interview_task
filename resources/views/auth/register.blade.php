@extends('auth.app')
@section('content')
    <div class="container">
        <div class="card_body">
            <form id="registerForm" class="form">
                <h2 class="title">Register Form</h2>
                <div class="mb-1">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="mb-1">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirm_password"
                        class="form-control">
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
