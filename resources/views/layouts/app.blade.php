
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Musée des Beaux Arts</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS And JavaScript -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.slim.min.js') }}"></script>


</head>

<body>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Musée des Beaux Arts</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="@if(URL::current() == URL::to('/')) active @endif"><a href="/">Accueil</a></li>
                <li class="@if(URL::current() == URL::to('/admin')) active @endif"><a href="/admin">Accès administrateur</a></li>
                <li class="@if(URL::current() == URL::to('/guestbook')) active @endif"><a href="/guestbook">Livre d'or</a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    @yield('content')
    @yield('post-js')
</div>

</body>
</html>

