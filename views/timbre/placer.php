{{ include('layouts/header.php', {title:'Créer enchère'})}}
    
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
            <h2>Créer un enchère</h2>
            <label class="label-form">Prix plancher <br>
                <input type="number" name="prix_plancher" value="{{timbre.prix_plancher}}">
            </label>
            <label class="label-form">Valeur estimée <br>
                <input type="number" name="valeur_estimee" value="{{timbre.valeur_estimee}}">
            </label>
            <input type="submit" class="btn-input" value="Sauvegarder">
                      

        </form>
    </div> 

</html>

{{ include('layouts/footer.php')}}