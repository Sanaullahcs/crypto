<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link rel="stylesheet" href="datatables/css/bootstrap.min.css">
    <link rel="stylesheet" href="datatables/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="datatables/css/buttons.dataTables.min.css">
    <script src="https://js.stripe.com/v3/"></script>

</head>

<body style=" min-height: 80vh;padding-bottom:20px;font-family: sans-serif;font-size: 11px !important;">
    <div id="app">

        <app-component></app-component>
    </div>
    <script src="{{ mix('/js/app.js') }}" defer></script>

    {{-- <script src="datatables/js/jquery-3.7.0.js" defer></script> --}}
    <script src="datatables/js/jquery.dataTables.min.js" defer></script>
    <script src="datatables/js/dataTables.bootstrap5.min.js" defer></script>
    <script src="datatables/js//dataTables.buttons.min.js" defer></script>
    <script src="datatables/js//buttons.html5.min.js" defer></script>



</body>

</html>