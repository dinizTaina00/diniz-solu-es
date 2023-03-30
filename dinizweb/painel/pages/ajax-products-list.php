<?php 
	
	if (isset($_POST['action'])) {

		switch ($_POST['action']) {
			case 'add':
			$id = $_POST['id'];
			$material = $_POST['material'];
			$quantity = $_POST['quantity'];

				$item = array($material=>array('material'=>$material,'quantity'=>$quantity));
				
				if(!empty($_SESSION['products_list'])){
					if(in_array($id,$_SESSION['products_list'])){
						foreach($_SESSION['products_list'] as $key => $product_on_list){
							if($id == $key){
								$_SESSION['products_list'][$key]['quantity'] = $_POST['quantity'];
							}
						}
					} else {
						$_SESSION['products_list'] = array_merge($_SESSION['products_list'],$item);
					}
				} else {
					$_SESSION['products_list'] = $item;
				}

				break;

			case 'empty':
				unset($_SESSION['products_list']);
				break;
		}
	}

$output = '';

if(isset($_SESSION['products_list'])){

		foreach($_SESSION['products_list'] as $produto){

			$output .= "<div class='card-body'>
					<p>".$produto['material']."</p>
					<p>".$produto['quantity']."</p>
				  </div>
				  ";

		}
	}
echo $output;


?>


