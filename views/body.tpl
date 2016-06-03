<form method="post" action="index.php" id="search">
	<div class="input-container">
		<i class="fa fa-search" aria-hidden="true"></i>
		<input type="text" name="search" placeholder="{% if searchWord is defined %} {{ searchWord }} {% else %}Rechercher ...{% endif %}">
		{% if search is defined %} <a href="index.php" id="close-search"><i class="fa fa-times" aria-hidden="true"></i></a> {% endif %}
	</div>
	<input type="hidden" name="action" value="search">
	<input type="submit" name="send" style="display:none;">
</form>	
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
				<div class="info-container" id="profil{{ profil.PAX_NUM_FICHE }}">
					<i class="fa fa-info-circle" aria-hidden="true"></i>
				</div>
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
	{% set calcul = (100 * arrival.0|number_format) / nbInvites|number_format %}
	<div class="chart" data-percent="{{ calcul }}">
		<div class="percent"></div>
	</div>
</div>	

{% for profil in profils %}
	<div class="profil-container" client="profil{{ profil.PAX_NUM_FICHE }}" style="z-index: {% if loop.index == 1 %} 2 {% else %} 1; display:none; {% endif %}">
		<h2><i class="fa fa-info-circle" aria-hidden="true"></i> INFORMATIONS INVITÉS</h2>
		<p>{{ profil.PAX_NOM | convert_encoding('UTF-8', 'ISO-8859-1') }} {{ profil.PAX_PRENOM | convert_encoding('UTF-8', 'ISO-8859-1') }}</p>
		<p class="bu">Directeur clientèle : {% if profil.PAX_DIRECTEUR_CLIENTELE != "" %} {{ profil.PAX_DIRECTEUR_CLIENTELE | convert_encoding('UTF-8', 'ISO-8859-1') }} {% else %} - {% endif %}</p>
		<p class="mobile" style="{% if profil.PAX_MOBILE == "" %} font-size: 11px !important; {% endif %}">{% if profil.PAX_MOBILE != "" %} {{ profil.PAX_MOBILE }} {% else %} Numéro de téléphone non communiqué {% endif %}</p>
	</div>
{% endfor %}
<div class="clearfix"></div>