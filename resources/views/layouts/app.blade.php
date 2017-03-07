<!DOCTYPE html>
<html lang="en">
<head>
    <title class="notranslate">Musée des Beaux Arts Bordeaux</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.slim.min.js') }}"></script>
    <!-- CSS And JavaScript -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'fr',
                includedLanguages: 'en,es',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>

<body>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand notranslate">Musée des Beaux Arts Bordeaux</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="@if(URL::current() == URL::to('/')) active @endif"><a href="/">Sondage</a></li>
                <li class="@if(URL::current() == URL::to('/guestbook')) active @endif"><a href="/guestbook">Livre
                        d'or</a></li>
                <li class="@if(URL::current() == URL::to('/admin')) active @endif"><a href="/admin">Accès
                        administrateur</a></li>
                <li>
                    <div id="google_translate_element"></div>
                </li>
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
