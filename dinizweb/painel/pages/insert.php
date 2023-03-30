<?php
	
	$arrayMaterials = array($_POST['id']=>array('material'=>$_POST['material'], 'quantity'=>$_POST['quantity']));

	if (isset($_SESSION['materials_list'])) {
		if(in_array($_POST['id'],$_SESSION['materials_list'])){
			foreach($_SESSION['materials_list'] as $key => $material){
				if ($_POST['id'] == $key) {
					$_SESSION['materials_list'][$key]['quantity'] = $_POST['quantity'];
				}
			}
		} else {
			$_SESSION['materials_list'] = array_merge($_SESSION['materials_list'],$arrayMaterials);
		}
	} else {
		$_SESSION['materials_list'] = $arrayMaterials;
	}

?>