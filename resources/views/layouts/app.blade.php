<!DOCTYPE html>

<html lang="en">
<head>
    <title>Diss Plan</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>

<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Planning</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{'/topics'}}">Topics</a></li>
                <li><a href="{{'/activities'}}">Activities</a></li>
                <li><a href="{{'/saves'}}">Saves</a></li>
            </ul>
        </div>
    </nav>
</div>

@yield('content')

</body>

<script src="{!! asset('js/app.js') !!}"></script>
<script src="{!! asset('js/jquery-ui.min.js') !!}"></script>
<script src="{!! asset('js/custom.js') !!}"></script>

</html>