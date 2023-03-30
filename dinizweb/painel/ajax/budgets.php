<?php 
	
include '../../config.php';

$output = "";

if(isset($_SESSION['products_list'])){

$output .= '<div class="table-responsive">
        	<table class="table">
        		<thead>
        			<tr>
        				<th>Produto</th>
        				<th>Quantidade</th>
        				<th>Preço de venda</th>
        				<th>Preço de custo</th>
        				<th>Cabeado</th>
        				<th>Preço de instalação</th>
        				<th></th>
        			</tr>
        		</thead>
        		<tbody>';
        			
        foreach($_SESSION['products_list'] as $produto){
        			
        $output .=	'<tr>
        				<td>'. $produto['product'] .'</td>
        				<td>'. $produto['quantity'] .'</td>
        				<td>R$ '. Painel::convertMoney($produto['sale_price']).' </td>
        				<td>R$ '. Painel::convertMoney($produto['cost_price']).' </td>
        				<td id="wired"> '.$produto['wired'].' </td>
        				<td>R$'. Painel::convertMoney($produto['installation_price']).' </td>
        				<td><a href="update?id='.$produto['id'].'">Atualizar</a></td>
        				<td><a href="delete?id='.$produto['id'].'"><i class="fa-solid fa-trash"></i></a></td>
        			</tr>';
        			
        			}
        			
        $output .=	'</tbody>
        			</table>
        			</div>';
			$output .= '<form class="empty" action="'.INCLUDE_PATH_PAINEL.'ajax/formsBudgets.php" method="post"><input type="submit" value="Adicionar" class="btn btn-sm- btn-dark my-4"></form>';
			echo $output;

	}

?>