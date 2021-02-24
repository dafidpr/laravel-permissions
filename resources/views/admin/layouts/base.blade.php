<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}">
    <title><?php echo $title?> | Laravel Permission App</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin/assets/assets/css/dashlite.css?ver=2.2.0') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/assets/css/style.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin/assets/assets/css/theme.css?ver=2.2.0') }}">

        <!-- Start datatable css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/responsive.bootstrap4.min.css') }}">
    <script>
        var url = '{{ url("") }}';
    </script>
</head>

<body class="nk-body bg-white has-sidebar ">
    @yield('child')
    @yield('script')
</body>

</html>