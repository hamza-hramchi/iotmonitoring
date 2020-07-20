<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <router-link class="navbar-brand" to="/">IOT Monitoring</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <router-link  class="nav-link" :to="{name :'home' }">Accueil</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link text-success" :to="{name : 'addModule' }">Ajouter un module</router-link>
                </li>
              </ul>
            </div>
          </nav>
        <div class="container mt-5">
                <router-view></router-view> <!-- Zone d'affichage des composants--->
        </div>
    </div>
</body>
</html>