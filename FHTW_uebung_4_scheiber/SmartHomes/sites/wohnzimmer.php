<link rel="stylesheet" type="text/css" href="res/css/style.css">
<?php 
	if(isset($_GET['un']) && isset($_GET['pw']))
	{
		$username=$_GET['un'];
		$passwort=$_GET['pw'];
	}
?>
<div class="container" id="wohnzimmer">
	<h2>Wohnzimmer</h2>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<h3>Licht</h3>
			<img src="res/img/light_on.png" alt="Licht an" />
			<p>Licht an</p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<h3>Temperatur</h3>
			<img src="res/img/temp_high.jpg" alt="Temperatur hoch" />
			<p>Temperatur 23 Grad</p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<h3>Details</h3>
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
		</div>
	</div>
</div>