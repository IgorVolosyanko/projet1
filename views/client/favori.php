{{ include('layouts/header.php', {title:'Favori'})}}
    
    <div class="container"> 
        <h1>Les favoris de {{nom}}</h1>
    </div>
  
    <div class="conteneur-grille">    
        {% for carte in cartes %}
        <div class="carte-timbre">
            <div class="timbre">
                <img src="{{asset}}/img/{{carte.image}}" alt="Timbre" />
            </div>
            <div class="bouton"> 
                <form method="POST">
                    <input type="hidden" name="id" value="{{carte.timbre_id}}">        
                    <button type="submit" class="btn btn-petit">Effacer</button>
                </form>
            <a class="btn btn-petit offre " href="{{base}}/fiche-enchere?id={{carte.timbre_id}}">Voir enchère</a>
            </div> 
        </div>                    
        {% endfor %}        
    </div>
</html>

{{ include('layouts/footer.php')}}