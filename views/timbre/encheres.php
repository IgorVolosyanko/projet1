{{ include('layouts/header.php', {title:'Créer enchère'})}}
    
    <div class="container"> 
        <h1>Les enchères de {{nom}}</h1>
    </div>
  
    <div class="conteneur-grille">    
        {% for carte in cartes %}
        <div class="carte-timbre">
            <div class="timbre">
                <img src="{{asset}}/img/{{carte.image}}" alt="Timbre" />
            </div>
            <div class="bouton"> 
                <form action="{{base}}/delete-enchere" method="POST">
                    <input type="hidden" name="id" value="{{carte.timbre_id}}">        
                    <button type="submit" class="btn btn-petit">Effacer</button>
                </form>
            </div> 
        </div>                    
        {% endfor %}        
    </div>
</html>

{{ include('layouts/footer.php')}}