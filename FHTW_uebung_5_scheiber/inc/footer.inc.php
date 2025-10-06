<script type='text/javascript' src='./res/script/script.js'></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container" id="footer">
	<div class="footerLink">
		<?php 
			if(isset($_GET['un']) && isset($_GET['pw']))
			{
				$username=$_GET['un'];
				$passwort=$_GET['pw'];
			}
			if(!empty($username) && !empty($passwort))
			{
				echo "<a href='index.php?menu=Impressum&un=$username&pw=$passwort'>Impressum</a>";
			}
			else
			{
				echo "<a href='index.php?menu=Impressum'>Impressum</a>";
			}
		?>
	</div>
	<div class="smLinks">
		<!--Facebook-->
		<a href="https://www.facebook.com" id="Facebook">
			<i class="fa fa-facebook-f"></i>
			Facebook
		</a>
		<!--Twitter-->
		<a href="https://www.twitter.com" id="Twitter">
			<i class="fa fa-twitter"></i>
			Twitter
		</a>
		<!--Google +-->
		<a href="https://www.plus.google.com" id="GooglePlus">
			<i class="fa fa-google-plus"></i>
			Google +
		</a>
		<!--Linkedin-->
		<a href="https://www.linkedin.com" id="Linkedin">
			<i class="fa fa-linkedin"></i>
			Linkedin
		</a>
		<!--Instagram-->
		<a href="https://www.instagram.com" id="Instagram">
			<i class="fa fa-instagram"></i>
			Instagram
		</a>
		<!--Pinterest-->
		<a href="https://www.pinterest.com" id="Pinterest">
			<i class="fa fa-pinterest"></i>
			Pinterest
		</a>
	</div>
	<div class="smLinks">
		<!--Snapchat-->
		<a href="http://www.snapchat.com" id="Snapchat">
			<i class="fa fa-snapchat-ghost" id="snapchat-ghost"></i>
			Snapchat
		</a>
		<!--Skype-->
		<a href="http://www.skype.com" id="Skype">
			<i class="fa fa-skype"></i>
			Skype
		</a>
		<!--Android-->
		<a href="http://www.android.com" id="Android">
			<i class="fa fa-android"></i>
			Android
		</a>
		<!--YouTube-->
		<a href="http://www.youtube.com" id="YouTube">
			<i class="fa fa-youtube"></i>
			YouTube
		</a>
		<!--Vimeo-->
		<a href="http://www.vimeo.com" id="Vimeo">
			<i class="fa fa-vimeo"></i>
			Vimeo
		</a>
		<!--Reddit-->
		<a href="http://www.reddit.com" id="Reddit">
			<i class="fa fa-reddit"></i>
			Reddit
		</a>
	</div>
</div>