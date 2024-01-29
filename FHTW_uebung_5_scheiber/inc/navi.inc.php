<script type='text/javascript' src='./res/script/script.js'></script>
<?php
	$navigation['Home'] = '?menu=Home';
	$navigation['Schlafzimmer'] = '?menu=Schlafzimmer';
	$navigation['Wohnzimmer'] = '?menu=Wohnzimmer';
	$navigation['Esszimmer'] = '?menu=Esszimmer';
	$navigation['Kueche'] = '?menu=Kueche';
	$navigation['Aussenbereich'] = '?menu=Aussenbereich';
	$navigation['Kontakt'] = 'mailto:sa19b025@technikum-wien.at';
	if(isset($_SESSION['un']) && $_SESSION['un']=='admin' && $_SESSION['pw']=='admin')
	{
		$navigation['Zimmerliste'] = '?menu=Zimmerliste';
		$navigation['NeuerRaum'] = '?menu=NeuerRaum';
		$navigation['RESTAPI'] = '?menu=RESTAPI';
	}

?>
<nav class='nav-pills bg-dark'>
	<ul class='nav navbar'>
	<?php
	if(isset($_GET['un']) && isset($_GET['pw']))
	{
		$username=$_GET['un'];
		$passwort=$_GET['pw'];
	}
	if(!empty($username) && !empty($passwort))
	{
		foreach ($navigation as $key => $value)
		{
	    	if (!empty($_GET['menu']) && $_GET['menu']==$key)
	    	{
		    echo "
			  <li class='nav-item'>
				<a class='nav-link text-white active' id ='$value' href='$value&un=$username&pw=$passwort'>$key</a>
			  </li>";
			}
			else
			{
			echo "
			  <li class='nav-item'>
				<a class='nav-link text-white' id ='$value' href='$value&un=$username&pw=$passwort'>$key</a>
			  </li>";
			}
		}
	}
	else
	{
		foreach ($navigation as $key => $value)
		{
	    	if (!empty($_GET['menu']) && $_GET['menu']==$key)
	    	{
		    echo "
			  <li class='nav-item'>
				<a class='nav-link text-white active' id ='$value' href='$value'>$key</a>
			  </li>";
			}
			else
			{
			echo "
			  <li class='nav-item'>
				<a class='nav-link text-white' id ='$value' href='$value'>$key</a>
			  </li>";
			}
		}
	}
	
	
	  ?>
	</ul>
</nav>
