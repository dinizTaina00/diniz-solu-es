<?php 
	
	$output = " ";

	foreach($_SESSION['products_list'] as $produto){

		$output .= "<div class='card-body'>
						<p>".$produto['name']."</p>
					</div>";

	}

	echo $output;

?>