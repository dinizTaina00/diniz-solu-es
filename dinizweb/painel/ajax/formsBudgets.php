<?php 
	session_start();
	sleep(1);
	$data['sucesso'] = true;
	
	if($_POST['acao'] == 'empty'){
		echo "<script>alert('ok');</script>";
	}

	if($_POST['acao'] == 'add'){
		$id = $_POST['id'];
			$product = $_POST['product'];
			$quantity = $_POST['quantity'];
			$sale_price = $_POST['sale_price'];
			$cost_price = $_POST['cost_price'];
			$wired = $_POST['wired'];
			if ($wired == "sim") {
				$installation_price = $_SESSION['wired_installation_price'];
			} else if($wired == "nao"){
				$installation_price = $_SESSION['simple_installation_price'];
			}

				$item = array($product=>array('id'=>$_POST['id'],'product'=>$product,'quantity'=>$quantity,'sale_price'=>$sale_price,'cost_price'=>$cost_price,'wired'=>$wired,'installation_price'=>$installation_price));
				
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
	}
				
die(json_encode($data));

?>