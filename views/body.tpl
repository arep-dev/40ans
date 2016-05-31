<div id="list-container">
	<form method="post">
		{% for profil in profils %}
		<label for="{{ loop.index }}">
			<input type="checkbox" name="profil" value="" id="{{ loop.index }}">
			<p>{{ profil.PAX_NUM_FICHE }} {{ profil.PAX_NOM | convert_encoding('UTF-8', 'ISO-8859-1') }} {{ profil.PAX_PRENOM | convert_encoding('UTF-8', 'ISO-8859-1') }}</p>
		</label>	
		{% endfor %}
		<div class="clearfix"></div>
	</form>
</div>