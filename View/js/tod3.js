$(document).ready(function(){
	$('#btn_show_solo').click(function(){
			$('#defi_solo').slideDown('slow');
			$('#btn_hide_solo').show();
			$(this).hide();
		
	});
	
	$('#btn_hide_solo').click(function(){
			$('#defi_solo').slideUp();
			$('#btn_show_solo').show();
			$(this).hide();
		
	});
	
	$('#btn_show_multi').click(function(){
			$('#defi_multi').slideDown('slow');
			$('#btn_hide_multi').show();
			$(this).hide();
		
	});
	
	$('#btn_hide_multi').click(function(){
			$('#defi_multi').slideUp();
			$('#btn_show_multi').show();
			$(this).hide();
		
	});

	$(".sortable").tablesorter(); 
	
	
	
});
