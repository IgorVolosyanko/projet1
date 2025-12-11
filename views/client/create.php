{{ include('layouts/header.php', {title:'Nouveau Client'})}}
    
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
            <h2>Créer nouveau client</h2>
            <label class="label-form">Nom <br>
                <input type="text" name="nom" value="{{client.nom}}">
            </label>
            <label class="label-form">Nom d'utilisateur<br>
                <input type="text" name="nom_utilisateur" value="{{client.nom_utilisateur}}">
            </label>
            <label class="label-form">Mot de passe<br>
                <input type="text" name="mot_de_passe" value="{{client.mot_de_passe}}">
            </label>
            <label class="label-form">Adresse <br>
                <input type="text" name="adresse" value="{{client.adresse}}">
            </label>
            <label class="label-form">Code Postal<br>
                <input type="text" name="code_postal" value="{{client.code_postal}}">
            </label>            
            <label class="label-form">Courriel <br>
                <input type="email" name="courriel" value="{{client.courriel}}">
            </label>
            <label class="label-form">Téléphon <br>
                <input type="text" name="telephone" value="{{client.telephone}}">
            </label>
            <label class="label-form">Ville <br>
                <input type="text" name="ville_id" value="{{client.ville}}">
            </label>
            <label class="label-form">Pays <br>
                <input type="text" name="pays_id" value="{{client.pays}}">
            </label>
            <label class="label-form">Privilege 
                <select name="privilege_id">
                    <option value="">Select</option> 
                    {% for privilege in privileges %}
                        <option value="{{privilege.id}}" {% if privilege.id == client.privilege_id %} selected {% endif %}>{{ privilege.nom}}</option>                        
                    {% endfor %}                    
                </select> 
            </label>                        
            <input type="submit" class="btn-input" value="Sauvegarder">

        </form>
    </div> 

</html>

{{ include('layouts/footer.php')}}