<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        body { background: white !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
     </style>
     

</head>
<body>
    <div id="app">
        <main>
            @yield("report-body")
        </main>
    </div>
</body>
</html>