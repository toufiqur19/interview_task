<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('frontend.partials.navbar')

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('script')

    <script>
        $(document).on('click', '#logoutButton', function(e) {
            e.preventDefault();

            const token = localStorage.getItem('sanctum_token');

            if (!token) {
                errorToast('You are not logged in.');
                return;
            }

            $.ajax({
                url: '/api/logout',
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    localStorage.removeItem('sanctum_token');
                    successToast(response.message);
                    window.location.href = '/';
                },
                error: function(xhr, status, error) {
                    errorToast('Logout failed.');
                }
            });
        });
    </script>
</body>

</html>
