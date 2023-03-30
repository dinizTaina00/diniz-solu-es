<?php
	
	require('vendor/autoload.php');
	
	$mp = new MP('113500073263349','1iJpnnKuzrHbFWrykj5OQNRbxuz9Z46Y');

	$data = array(
					'items'=> array(),
					'shipments'=> array(
									'mode'=>'custom',
									'cost'=>20.00,
									'receiver_adress'=>array('zip_code'=>'98170-000')
									),
					'back_urls'=>array('success'=>'http://localhost/dinizweb/app/mercado_pago/obrigado.php',
										'pending'=>'http://localhost/dinizweb/app/mercado_pago/pendente.php',
										'failure'=>'http://localhost/dinizweb/app/mercado_pago/falhou.php',
									),
					'notification_url'=>'http://localhost/dinizweb/app/mercado_pago/notificacao.php',
					'auto_return'=>'approved',
					'external_reference'=>uniqid()
				);

		$data['items'][0] = array('title'=>'Camera', 'quantity'=>1, 'current_id'=>'BRL', 'unit_price'=>200.00);

		$link = $mp->create_preference($data);
		
		header('Location: '.$link['response']['sandbox_init_point']);
		die();
?>