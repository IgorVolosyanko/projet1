{{ include('layouts/header.php', {title:'Fiche'})}}

<div class="grille-fiche">
      <section class="grille-grand">
        <div class="timbres">
        {% for image in images %} 
            {% if loop.index0 != 0 %}           
                <div class="timbre-supelementaire">
                    <a href="{{base}}/fiche-enchere?id={{id}}&index={{loop.index-1}}">
                    <img src="{{asset}}/img/{{image}}" alt="Timbre" />
                    </a>
                    {{loop.index-1}}
                </div>
            {% endif %} 
        {% endfor %} 
        </div>     

        <input type="checkbox" id="zoom" hidden />
        <label for="zoom" class="timbre-grand">
            <img src="{{asset}}/img/{{images[0]}}" alt="Timbre" />
        </label>
        <div class="description">
          <div class="temps">
            <div>
              <h3>{{temps.jours}}</h3>
              <small>JOURS</small>
            </div>
            <div>
              <h3>{{temps.heurs}}</h3>
              <small>HEURES</small>
            </div>
            <div>
              <h3>{{temps.minute}}</h3>
              <small>MINUTES</small>
            </div>
            <div>
              <h3>{{temps.seconde}}</h3>
              <small>SECONDES</small>
            </div>
          </div>
          <small>OFFRE ACTUELLE</small>
          <h2>CAN$ {{timbre.offre}}</h2>
          <p>Estimation</p>
          <form class="place" method="POST">
            <label for="valeur">{{timbre.estimation}}</label>
            <input
              type="text"
              placeholder="2 ou plus"
              name="valeur"
              id="valeur"
            />
            <input type="hidden" name="enchere_id" value="{{timbre.enchere_id}}">
            <input type="hidden" name="utilisateur_id" value="{{timbre.id}}">
            <div class="boutons">
              <button class="btn btn-grand">Placez votre offre</button>              
            </div>
          </form>
          <a class="btn btn-petit favori" href="{{base}}/favori?id={{timbre.id}}">Favori</a>
          <div class="livraison">
            <img src="{{asset}}/img/truck.svg" alt="" />
            <span>45 $ depuis {{timbre.pays_utilisateur}}, livré dans 12-33 jours</span>
          </div>
          <p>Moyens de paiement</p>

          <div class="paiement">
            <img
              src="{{asset}}/img/73069_base_mastercard_sketch_icon.png"
              alt="Master Card"
            />
            <img
              src="{{asset}}/img/icons8-visa-48.png"
              alt="Visa icon by Icons8"
            />
            <img
              src="{{asset}}/img/icons8-apple-pay-card-48.png"
              alt="Apple-pay-card"
            />
            <img src="{{asset}}/img/icons8-google-pay-48.png" alt="Google-pay" />
            <img src="{{asset}}/img/icons8-paypal-48.png" alt="Paypal" />
            <img src="{{asset}}/img/icons8-sepa-48.png" alt="Sepa" />
          </div>
        </div>
      </section>
      <article class="conteneur-info">
        <h3>Détails</h3>
        <div class="conteneur-grille">
          <div>
            <small>Nom du timbre</small>
            <p>{{timbre.nom}}</p>
          </div>
          <div>
            <small>Tirage</small>
            <p>{{timbre.tirage}}</p>
          </div>
          <div>
            <small>Pays</small>          
            <p>{{timbre.pays}}</p>
          </div>
          <div>
            <small>Dimension</small>
            <p>{{timbre.dimension}}</p>
          </div>
          <div>
            <small>Certifié ou non certifié</small>
            <p>{{timbre.certifie}}</p>
          </div>
          <div>
            <small>Condition</small>
            <p>{{timbre.condition}}</p>
          </div>
          <div>
            <small>Couleur</small>
            <p>{{timbre.couleur}}</p>
          </div>
          <div>
            <small>Vendeur</small>
            <p>{{timbre.utilisateur}}</p>
          </div>
        </div>
        </article>
        </div>
{{ include('layouts/footer.php')}}