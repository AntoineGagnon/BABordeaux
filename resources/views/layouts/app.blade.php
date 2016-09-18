<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GoogSondage</title>
         <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <!-- CSS And JavaScript -->
    </head>

    <body>
        <div>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">GoogSondage</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/">Accueil</a></li>
                        <li><a href="/sondage/create">Création de sondage</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        
         <div class="container">
            @yield('content')
        </div>
        
    </body>
</html>