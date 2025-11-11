$(function(){
		$('.carousel').carousel('pause');
		$('.abreMenu').click(function(e){
			e.preventDefault();
			$('.menu-detalle').collapse("hide");
			var id=$(this).data('id');
			$('#'+id).collapse("toggle");
			
		});
		
		var doc=$(document).outerWidth();
		
		var alto=$('#presentacion').height();
		var ancho=$('#presentacion').width();
		var alto2=$('#accesos').height();
		var anchobotones=$('#botones').width();
		//alert(altot);
		if(doc>'768'){
			var altot=(alto - 32);
			var altoboton=(altot / 3);
			var altoacceso=altoboton;
			console.log('pantalla grande');
		}else{
			var altot=(alto - 16);
			var altoboton=(altot / 2);
			var altoacceso=(altoboton + altoboton + 16);
				console.log('pantalla chica');

		}
		console.log(altoboton+' alto boton');
		console.log('alto ventana '+doc);
		console.log('alto boton '+altoboton);
		//alert(altoboton);
		$('.menu-detalle').outerWidth(ancho);
		$('#botones .list-link').outerHeight(altoboton);
		$('#accesos .link-acceso').outerHeight(altoboton);
	});