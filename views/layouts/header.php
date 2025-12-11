

    <!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset}}css/style.css" />
    <title>Stampee</title>
  </head>
  <body>
    <header class="conteneur-menu">
      <nav class="menu">
        <ul class="connexion">
          <li><a href="{{base}}/create">S'inscrire</a></li>
          {% if guest %}
          <li class="liste"><a href="{{base}}/login">Se connecter</a></li>
          {% else %} 
          <li class="liste"><a href="{{base}}/logout">Se déconnecter</a></li>
          {% endif %}
        </ul>

        <ul>
          <li class="menu-deroulant">
            <a href="#">Aide & Guide</a>
            <ul class="sous-menu">
              <li><a href="#">Comment placer une offre</a></li>
              <li><a href="#">Profil</a></li>
              <li><a href="{{base}}/publish">Publier une enchère</a></li>
              <li><a href="{{base}}/encheres">Mes enchères</a></li>
            </ul>
          </li>

          <li class="menu-deroulant">
            <a href="#">Communauté</a>
            <ul class="sous-menu">
              <li><a href="#">Forum</a></li>
              <li><a href="#">Agenda</a></li>
              <li><a href="#">Blog</a></li>
            </ul>
          </li>
        </ul>

        <ul>
          <li><a href="#">Favoris</a></li>
          <li class="menu-deroulant">
            <a href="#">Français</a>
            <ul class="sous-menu">
              <li><a href="#">Français</a></li>
              <li><a href="#">English</a></li>
              <li><a href="#">Español</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <div class="conteneur-entete">
        <div class="logo">
          <a href="{{base}}"
            ><img src="{{ asset }}/img/logo-alt.png" alt="Logo Stampee"
          /></a>
        </div>
        <ul>
          <li><a href="{{base}}">Accueil</a></li>
          <li><a href="#">Collections</a></li>
          <li><a href="#">À propos de Lord</a></li>
        </ul>
        <div>
          <input
            type="search"
            placeholder="Rechercher..."
            class="form-control"
            id="recherche"
          />
          <label for="recherche"
            ><img src="{{ asset }}/img/search.svg" alt="Loupe"
          /></label>
        </div>
      </div>
    </header>

    <div class="annonce">
      <div class="bloc-img">
        <img src="{{ asset }}/img/annonceImg.webp" alt="Timbre" />
      </div>
      <div class="texte">
        <h2>Timbres</h2>
        <p>
          Des millions de timbres de collection du monde entier ainsi que des
          courriers anciens pour les collectionneurs. Achetez et vendez au
          meilleur prix.
        </p>
      </div>
    </div>