{{ include('layouts/header.php', {title:'Se connecter'})}}
    <div class="container">
        
        {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        
        <form class="input-form" method="post">
            <h2>Se connecter</h2>
            <label class="label-form">Nom d'utilisateur <br>
                <input type="name" name="nom_utilisateur" value="{{user.nom_utilisateur}}">
            </label>
            <label class="label-form">Mot de passe <br>
                <input type="password" name="mot_de_passe" >
            </label class="label-form">
            <input type="submit" class="btn-input" value="Login">
        </form>
    </div>
{{ include('layouts/footer.php')}}