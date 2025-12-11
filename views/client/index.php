{{ include('layouts/header.php', {title:'Accueil'})}}
    

<section class="titre">
      <h1>Timbres Stampee en enchère</h1>
      <h2>Le plus grand choix des timbres internationnal</h2>
    </section>
    <div class="conteneur-principal">
      <aside class="selecteur">
        <div class="categories">
          <h2>Catégorie</h2>
          <ul>
            <li><a href="#">Afrique</a></li>
            <li><a href="#">Amérique</a></li>
            <li><a href="#">Asie</a></li>
            <li><a href="#">Europe</a></li>
            <li><a href="#">Vrac</a></li>
            <li><a href="#">Autre</a></li>
          </ul>
        </div>
        <div class="filtre">
          <h3>Filtres</h3>

          <form>
            <fieldset>
              <legend>Type de vente</legend>
              <input
                class="radio-btn"
                id="cours"
                type="radio"
                name="vente"
                value="1"
                checked="checked"
              />
              <label for="cours">En cours</label>
              <br />

              <input
                class="check"
                id="fixes"
                type="checkbox"
                name="prix"
                value="3"
              />
              <label for="fixes">Prix fixes</label>
              <br />

              <input
                class="check"
                id="avec"
                type="checkbox"
                name="offre"
                value="4"
              />
              <label for="avec">Enchères avec offres</label>
              <br />
              <input
                class="check"
                id="sans"
                type="checkbox"
                name="sans-offre"
                value="5"
              />
              <label for="sans">Enchères sans offres</label>
              <br />

              <input
                class="check"
                id="ventes"
                type="checkbox"
                name="maison"
                value="6"
              />
              <label for="ventes">Maison de vente</label>
              <br />
              <input
                class="radio-btn"
                id="vendu"
                type="radio"
                name="vente"
                value="2"
              />
              <label for="vendu">Vendus</label>
              <br />
            </fieldset>
          </form>
          <div class="prix-annee">
            <h4>Prix</h4>
            <label for="prix-bas">De</label>
            <input type="number" name="prix-bas" id="prix-bas" />
            <label for="prix-haut">à</label>
            <input type="number" name="prix-haut" id="prix-haut" />

            <h4 class="annee">Année</h4>
            <label for="annee-bas">De</label>
            <input type="number" name="annee-bas" id="annee-bas" />
            <label for="annee-haut">à</label>
            <input type="number" name="pannee-haut" id="annee-haut" />
          </div>
          <fieldset class="paiement-options">
            <legend>Mode de paiement</legend>
            <div class="mode-de-pay">
              <input
                class="check"
                id="master-card"
                type="checkbox"
                name="offre"
                value="1"
              />
              <img
                src="{{ asset }}/img/73069_base_mastercard_sketch_icon.png"
                alt="Master Card"
              />
              <label for="master-card">MasterCard</label>
              <br />
              <input
                class="check"
                id="visa"
                type="checkbox"
                name="sans-offre"
                value="2"
              />
              <img src="{{ asset }}/img/icons8-visa-48.png" alt="Carte Visa" />
              <label for="visa">Visa</label>
              <br />
              <input
                class="check"
                id="apple-pay"
                type="checkbox"
                name="maison"
                value="3"
              />
              <img
                src="{{ asset }}/img/icons8-apple-pay-card-48.png"
                alt="Apple Pay"
              />
              <label for="apple-pay">ApplePay</label>
              <br />
              <input
                class="check"
                id="googlepay"
                type="checkbox"
                name="maison"
                value="4"
              />
              <img src="{{ asset }}/img/icons8-google-pay-48.png" alt="GooglePay" />
              <label for="googlepay">GoolePay</label>
              <br />
              <input
                class="check"
                id="paypal"
                type="checkbox"
                name="maison"
                value="5"
              />
              <img
                src="{{ asset }}/img/icons8-paypal-48.png"
                alt="Platform PayPal icon"
              />
              <label for="paypal">PayPal</label>
              <br />
              <input
                class="check"
                id="sepa"
                type="checkbox"
                name="maison"
                value="6"
              />
              <img src="{{ asset }}/img/icons8-sepa-48.png" alt="Carte Sepa" />
              <label for="sepa">Sepa</label>
              <br />
            </div>
          </fieldset>
        </div>
      </aside>
      <div class="conteneur-grille">
      {% for carte in cartes %}
        <div class="carte-timbre">
          <div class="timbre">
            <img src="{{asset}}/img/{{carte.image}}" alt="Timbre" />
          </div>
          <details class="conteneur-contenu">
            <summary>Voir détails</summary>
            <small>{{carte.nom}}.</small>
            <small>Tirage {{carte.tirage}}.</small>
            <small>Timbre {{carte.certifie}}.</small>
            <small>Pays d'origine {{carte.pays}}.</small>
          </details>
          <div class="bouton">
            <p>status :</p>
            <span> en vente</span>
            <button class="btn btn-petit">Faire une offre</button>
          </div>
        </div>
      {% endfor %}
      </div>
      </div>  
      
{{ include('layouts/footer.php')}}