@extends('frontend.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                All Users List
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="user_id">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name">
                            <span class="text-danger" id="first_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name">
                            <span class="text-danger" id="last_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address">
                            <span class="text-danger" id="address_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city">
                            <span class="text-danger" id="city_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state">
                            <span class="text-danger" id="state_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">Zipcode</label>
                            <input type="text" class="form-control" id="zipcode">
                            <span class="text-danger" id="zipcode_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country">
                            <span class="text-danger" id="country_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        fetchUsers();

        function fetchUsers() {
            $.ajax({
                url: '/api/users',
                method: 'GET',
                success: function(response) {
                    $('#usersTable').empty();
                    for (let i = 0; i < response.data.length; i++) {
                        let user = response.data[i];
                        $('#usersTable').append(`
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.first_name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.email}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm editUser" data-bs-toggle="modal" data-id="${user.id}" data-bs-target="#editModal">Edit</button>
                                <button class="btn btn-sm btn-danger deleteUser" data-id="${user.id}">Delete</button>
                            </td>
                        </tr>
                    `);
                    }
                }
            });
        }

        $(document).on('click', '.editUser', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '/api/user/edit/' + id,
                method: 'GET',
                success: function(response) {
                    $('#user_id').val(response.data.id);
                    $('#first_name').val(response.data.first_name);
                    $('#last_name').val(response.data.last_name);
                    $('#address').val(response.data.address);
                    $('#city').val(response.data.city);
                    $('#state').val(response.data.state);
                    $('#zipcode').val(response.data.zipcode);
                    $('#country').val(response.data.country);
                }
            });
        });

        $(document).on('submit', '#updateForm', function(e) {
            e.preventDefault();
            let id = $('#user_id').val();
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let address = $('#address').val();
            let city = $('#city').val();
            let state = $('#state').val();
            let zipcode = $('#zipcode').val();
            let country = $('#country').val();
            let password = $('#password').val();

            // form validation
            if ($('#first_name').val() == '') {
                $('#first_name_error').text('First name is required');
                return;
            } else if ($('#last_name').val() == '') {
                $('#last_name_error').text('Last name is required');
                return;
            } else if ($('#address').val() == '') {
                $('#address_error').text('Address is required');
                return;
            } else if ($('#city').val() == '') {
                $('#city_error').text('City is required');
                return;
            } else if ($('#state').val() == '') {
                $('#state_error').text('State is required');
                return;
            } else if ($('#zipcode').val() == '') {
                $('#zipcode_error').text('Zipcode is required');
                return;
            } else if ($('#country').val() == '') {
                $('#country_error').text('Country is required');
                return;
            }

            $.ajax({
                url: '/api/user/update/' + id,
                method: 'POST',
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    address: address,
                    city: city,
                    state: state,
                    zipcode: zipcode,
                    country: country,
                    password: password
                },
                success: function(response) {
                    $('#editModal').modal('hide');
                    fetchUsers();
                    successToast(response.message);
                }
            });
        });

        $(document).on('click', '.deleteUser', function() {
            let id = $(this).data('id');
            let row = $(this).closest('tr');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/api/user/delete/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            row.remove();
                            successToast(response.message);
                        }
                    });
                }
            });
        })
    </script>
@endpush
