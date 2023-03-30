var include_path = $('base').attr('base');

$(function(){
	$('.ajax').ajaxForm({
		dataType:'json',
		data:{'acao':'add'},
		beforeSend:function(){
			$('.ajax').animate({'opacity': '0.6'});
			$('.ajax').find('input[type=submit]').attr('disabled','true');
		},
		success: function(data){
			$('.ajax').animate({'opacity': '1'});
			$('.ajax').find('input[type=submit]').removeAttr('disabled');
			get_products_list();
		}
	})

	function get_products_list(){
		$.ajax({
			dataType:'text',
			url:'http://localhost/dinizweb/painel/ajax/budgets.php',
			method:'post',
			data:{'acao':'get_products_list'}
			}).done (function(data){
			$('#list_products').html(data);
			console.log(data);
		})
	}
})