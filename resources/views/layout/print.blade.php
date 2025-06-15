
<!-- Create a print layout at resources/views/layouts/print.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
</head>
<body>
    @yield('content')
    
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>