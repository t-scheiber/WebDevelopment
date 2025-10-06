<link rel="stylesheet" type="text/css" href="res/css/style.css">
<div class="container">
	<form method="get" action="index.php">
		<input type="hidden" name="menu" value="Zimmerliste">
		<input type="hidden" name="un" value="admin">
		<input type="hidden" name="pw" value="admin">
		<table border="1" class="raum">
		<tr>
			<td>
				ID:	
			</td>
			<td>
				<input type="number" name="id" id="id" placeholder="id">
			</td>
		</tr>
		<tr>
			<td>
				Titel
			</td>
			<td>
				<input type="text" name="titel" id="titel" placeholder="Titel" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Raumgröße:
			</td>
			<td>
				<input type="number" name="qm" id="qm" placeholder="Größe in qm" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Licht an?
			</td>
			<td>
				<input type="checkbox" name="licht" id="licht" placeholder="licht" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Temperatur:
			</td>
			<td>
				<input type="number" name="temperatur" id="temperatur" placeholder="Temperatur in  °C" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Hintergrundbild wählen:
			</td>
			<td>
				<input type="text" name="hintergrundbild" id="hintergrundbild" placeholder="Hintergrundbild">
			</td>
		</tr>
		<tr>
			<td>
				Beschreibung
			</td>
			<td>
				<textarea name="beschreibung" id="beschreibung" placeholder="Beschreibung"></textarea> 
			</td>
		</tr>
		<tr>
			<td>
				<input type="reset">
			</td>
			<td>
				<input type="submit" name="add" value="Hinzufügen">
			</td>
		</tr>
	</table>
	</form>
</div>