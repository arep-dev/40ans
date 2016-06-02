<div id="list-container">
	<form method="post">
		{% for profil in profils %}
			<div class="list-container-profil">
					<input type="checkbox" name="{{ profil.PAX_NUM_FICHE }}" value="{% if profil.PAX_CHECKIN == 1 %} 1 {% else %} 0 {% endif %}" class="profil{{ profil.PAX_NUM_FICHE }}" checked>
					<i class="fa fa-check-circle-o check profil{{ profil.PAX_NUM_FICHE }} {% if profil.PAX_CHECKIN == 1 %}actif{% endif %}" aria-hidden="true"></i>
				<p>
					{% filter upper %}{{ profil.PAX_NOM | convert_encoding('UTF-8', 'ISO-8859-1') }}{% endfilter %} 
					{{ profil.PAX_PRENOM | convert_encoding('UTF-8', 'ISO-8859-1') }} <br>
					<span> {{ profil.PAX_SOCIETE | convert_encoding('UTF-8', 'ISO-8859-1') }} </span>
				</p>
			</div>	
		{% endfor %}
		<div class="clearfix"></div>
	</form>
</div>

<div id="stats">
	<h2>Nombre d'invités</h2>
	<p class="nbInvites">{{ nbInvites }}</p>
	<h2>Invités arrivés</h2>
	<p class="arrival">{{ arrival.0 }}</p>
	<h2>Invités attendus</h2>
	<p class="expected">{{ nbInvites - arrival.0 }}</p>
</div>	

{% for profil in profils %}
	<div id="profil-container" client="profil{{ profil.PAX_NUM_FICHE }}" {% if loop.index != 1 %} style="display:none" {% endif %}>
		<h2>Informations invité</h2>
	</div>
{% endfor %}
<div class="clearfix"></div>