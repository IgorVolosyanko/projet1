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
            <h2>Ajouter les images</h2>
            <label for="fichier">Sélectionnez un photo :</label>
            <input type="file" name="nom" accept="img/.png*">
            <input type="submit" class="btn-input" value="Envoyer">         

        </form>
    </div> 
    <form action="{{base}}/placer" method="GET">  
        <input type="hidden" name="id" value="{{timbre_id}}">     
        <button style="margin: 0 0 20px 50px" type="submit" class="btn-input btn-enchere">Créer enchère</button>
    </form>
    <div class="conteneur-grille">    
        {% for image in images %}
        <div class="carte-timbre">
            <div class="timbre">
                <img src="{{asset}}/img/{{image.nom}}" alt="Timbre" />
            </div>
            <div class="bouton"> 
            <!-- {{image.id}}  -->
                <form action="{{base}}/delete" method="POST">
                    <input type="hidden" name="id" value="{{image.id}}">        
                    <button type="submit" class="btn btn-petit">Effacer</button>
                </form>
            </div> 
        </div>                    
        {% endfor %}        
    </div>
</html>

{{ include('layouts/footer.php')}}