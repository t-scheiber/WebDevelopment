<script type='text/javascript' src='./res/script/script.js'></script>
<?php
	$navigation['Home'] = 'index.php?menu=Home';
	$navigation['Schlafzimmer'] = 'index.php?menu=Schlafzimmer';
	$navigation['Wohnzimmer'] = 'index.php?menu=Wohnzimmer';
	$navigation['Esszimmer'] = 'index.php?menu=Esszimmer';
	$navigation['Kueche'] = 'index.php?menu=Kueche';
	$navigation['Aussenbereich'] = 'index.php?menu=Aussenbereich';
	$navigation['Kontakt'] = 'mailto:sa19b025@technikum-wien.at';

	

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
