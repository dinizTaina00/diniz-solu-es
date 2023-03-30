<?php 

$output = '';

if(isset($_SESSION['products_list'])){

		foreach($_SESSION['products_list'] as $produto){

			$output .= "<div class='card-body'>
					<p>".$produto['material']."</p>
					<p>".$produto['quantity']."</p>
				  </div>";

		}
	}
echo $output;

// if(isset($_SESSION['materials_list'])){

// $output .= '<div class="table-responsive">
// 					<table class="table">
// 						<tr>
// 							<th>Material</th>
// 							<th>Quantidade</th>
// 						</tr>';


// 	foreach ($_SESSION['materials_list'] as $key => $item) {
// 	$output .= '<tr>
// 					<td>'.$item["material"].'</td>
// 					<td>'.$item["quantity"].'</td>
// 				</tr>';
// 	}
// 	$output .= '<tr>
// 					<td id="material" contenteditable></td>
// 					<td id="quantity" contenteditable></td>
// 					<td><button name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
// 				</tr>';

// } else {
// 	$output .= '<tr>
// 					<td id="material" contenteditable></td>
// 					<td id="quantity" contenteditable></td>
// 					<td><button name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
// 				</tr>';
// }

// $output .= '</table> </div>';

// echo $output;
?>