<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <title>部室予約表</title>
</head>
<body>
    <div id="app">
        <div id="header">
            <h1>部室予約表</h1>
        </div>
        <main-page />
    </div>
    <script src=" {{ mix('js/app.js') }} "></script>
</body>
</html>