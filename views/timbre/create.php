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
            <h2>Créer un timbre</h2>
            <label class="label-form">Nom <br>
                <input type="text" name="nom" value="{{timbre.nom}}">
            </label>
            <label class="label-form">Tirage<br>
                <input type="number" name="tirage" value="{{timbre.tirage}}">
            </label>
            <label class="label-form">Dimension <br>
                <input type="number" name="dimension" value="{{timbre.dimension}}">
            </label>
            <label class="label-form">Couleur<br>
                <input type="text" name="couleur_id" value="{{timbre.couleur_id}}">
            </label>            
            <label class="label-form">Pays <br>
                <input type="text" name="pays_id" value="{{timbre.pays_id}}">
            </label>
            
            <label class="label-form">Certifié 
                <select name="certifie">
                    <option value="">Select</option> 
                    <option value="1">certifié</option> 
                    <option value="2">non certifié</option>                  
                </select> 
            </label> 
            <label class="label-form">Condition 
                <select name="condition_id">
                    <option value="">Select</option> 
                    {% for condition in conditions %}
                        <option value="{{condition.id}}" {% if condition.id == timbre.condition_id %} selected {% endif %}>{{ condition.nom}}</option>                        
                    {% endfor %}                    
                </select> 
            </label>                        
            <input type="submit" class="btn-input" value="Sauvegarder">

        </form>
    </div> 

</html>

{{ include('layouts/footer.php')}}