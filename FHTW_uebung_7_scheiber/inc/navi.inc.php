<?php
	$navigation['Home'] = '?menu=Home';
	$navigation['Studenteninfo'] = '?menu=Studenteninfo';
	$navigation['Hochschulinfo'] = '?menu=Hochschulinfo';
	$navigation['Kontakt'] = 'mailto:sa19b025@technikum-wien.at';
?>

<nav class='nav-pills bg-dark'>
	<ul class='nav navbar'>
		<?php
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
		?>
	</ul>
</nav>