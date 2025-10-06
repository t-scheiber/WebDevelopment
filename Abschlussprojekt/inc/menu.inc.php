<?php

$menues = array(
            "Home" => "index.php",
            "Playlist" => "playlist.php",
			"Suche" => "");
?>
<nav class='nav-pills bg-dark'>
	<ul class='nav navbar'>
		<?php
			foreach ($menues as $key => $value)
			{
				
				if($key!="Suche"){
				echo "
					  <li class='nav-item'>
						<a class='nav-link text-white' id ='$key' href='$value'>$key</a>
					  </li>";
				}
				else
				{
					echo "
						 <li class='nav-item'>
						 	<form action='index.php' method='POST' class='form-inline'>
						 		<input type='search' name='suche' class='form-control' aria-label='Search' placeholder='Soundsearch'>
						 		<input type='submit' class='form-control' value='Submit' id='submit' />
						 	</form>
						 </li>";
				}}
		?>
	</ul>
</nav>