
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Musée des Beaux Arts</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS And JavaScript -->
</head>

<body>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Musée des Beaux Arts</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Accueil</a></li>
                <li><a href="admin">Accès administrateur</a></li>
                <li><a href="guestbook">Livre d'or</a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    @yield('content')
</div>

</body>
</html>