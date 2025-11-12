$(function(){

//chequea passwd si son iguales
	$(document).on('keyup', '.pass', function(e) {
	//$('.pass').keyup(function(e){
		if ( e.which == 13 ) {
		     e.preventDefault();
		  }
		var pass1=$('#pass1').val();
		var pass2=$('#pass2').val();
		console.log(pass1+'--'+pass2)
		if (pass1===pass2){
			$('.pass').addClass( "is-valid" ).removeClass("is-invalid");
			}
		else{
			$('.pass').addClass( "is-invalid" ).removeClass("is-valid");
			}
	});
//
	//borrar registros
	$(document).on('click', '.borrar', function(e) {
		e.preventDefault();
		if (!confirm("Esta seguro de que desea eliminar el registro?")) 
			{	return false; }
		else { 
			var id= $(this).data('id');
			var db= $(this).data('db');
			var url=$(this).data('url');
			$.post( "inc/borrar.php",{ id:id, db:db }, function( data ) {	        
				$('#centro').load(url);
			});
		}	
    });
	//
	$(document).on('click', '.ingreso', function(e) {
		e.preventDefault();
		$('#modal-ingreso').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});	
	//
	//('#imprime-etiquetas').click(function(e){
	$(document).on('click', '.imprimir', function(e) {
		e.preventDefault();
		var div=$(this).data('div');
		$('#'+div).printThis({
			canvas: true, 
			base:true
		});
	});
	$(document).on('click', '.exportar', function(e) {
		e.preventDefault();
		var div=$(this).data('div');
		var nombre=$(this).data('nombre');
		$("#"+div).tableExport({
		    headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
		    footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
		    formats: ["xls"],    // (String[]), filetypes for the export
		    fileName: nombre,                    // (id, String), filename for the downloaded file
		    bootstrap: true,                   // (Boolean), style buttons using bootstrap
		   	});
	});
	//
	$(document).on('click', '.mostrar', function(e) {
	e.preventDefault();
	  if($('.ver').hasClass('fa-eye'))
      {
		  $('.pass').removeAttr('type');
		  $('.ver').addClass('fa-eye-slash').removeClass('fa-eye');
      }
      else
      {
    	  $('.pass').attr('type','password');
    	  $('.ver').addClass('fa-eye').removeClass('fa-eye-slash');
      }
	});
	//
	$(document).on('click', '.egreso', function(e) {
		e.preventDefault();
		$('#modal-egreso').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});	
	//
	$(document).on('click', '.cargacsv', function(e) {
		e.preventDefault();
		$('#modal-csv').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});	
	$(document).on('submit', '#getcsv', function(e) {
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
		    url: $(this).attr('action'),
		    data: data,
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function(data){
			    $('#contenido').html(data);
			    $('#modal-csv').modal('hide');
				
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();	
			    
				}          
		    });	
		
	});	
	
	//
	$(document).on('change', '.categ', function(e) {
		e.preventDefault();
		var cat=$(this).val();
		var num=$(this).data('num');
		$.post("inc/get_categorias.php", { id:cat}, function(datos){
			console.log(datos);
			console.log(num);
			$('#subcateg'+num).html(datos);
			});
	});
	//
	$(document).on('submit', '#guardarcsv', function(e) {
		e.preventDefault();
		var data = new FormData(this);
		
		$.ajax({
			type: 'POST',
		    url: $(this).attr('action'),
		    data: data,
		    contentType: false,
		    cache: false,
		    dataType: "json",
		    processData: false,
		    success: function(data){
		    	if(data.success){
					alert('ok');
				}else{
					alert (data.error);
				}
			    
				}          
		    });	
		
	});	
	//
	$(document).on('submit', '#negreso-form', function(e) {
		e.preventDefault();
		var data = new FormData(this);
		
		$.ajax({
			type: 'POST',
		    url: $(this).attr('action'),
		    data: data,
		    contentType: false,
		    cache: false,
		    dataType: "json",
		    processData: false,
		    success: function(data){
		    	if(data.success){
					alert('Operacion Procesada');
					$('#modal-egreso').modal('hide');
					$('#negreso-form')[0].reset();
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();	
				}else{
					alert (data.error);
				}
			    
				}          
		    });	
		
	});	
});
function getCatML(id,div,input){
	if (id=='0'){
		var url="https://api.mercadolibre.com/sites/MLA/categories";
		$(input).val('');
	}else{
		var url="https://api.mercadolibre.com/categories/"+id;
		$(input).val(id);
	}
	$.getJSON( url, function( data ) {
		$(div).empty();
		if (id=='0'){
			var cat=data;
		}else{
			var cat = data.children_categories;
			var subc = data.path_from_root;
			var sit='<a href="#" class="linkCatMl" style="color:#fff;" data-id="0">Inicio</a>';	
			$.each( subc, function( clave, valor ){
				sit = sit + ' > <a href="#" class="linkCatMl " style="color:#fff;" data-id="' + valor.id + '">' + valor.name + '</a>';
			});	
			$(div).append("<span class=\"list-group-item-action list-group-item  list-group-item  active\">"+sit+"</span>");
		}
		$.each( cat, function( key, val ) {
			$(div).append( "<a href=\"#\" class=\"linkCatMl list-group-item list-group-item-action\" data-id='" + val.id + "'>" + val.name + "</a>" );
		});
		$('.active').focus(); 
	});
}
function getCat(id,div,input){
	if (id=='0'){
		var url="inc/get_categorias.php";
		$(input).val('');
	}else{
		var url="inc/get_categorias.php?id="+id;
		$(input).val(id);
	}
	$.getJSON( url, function( data ) {
		$(div).empty();
		if (id=='0'){
			var cat=data.categorias;
		}else{
			var cat = data.categorias;
			var subc = data.padres;
			subc.sort();
			var sit='';	
			$.each( subc, function( clave, valor ){
				sit = sit + '<a href="#" class="linkCat " style="color:#fff;" data-id="' + valor.id + '">' + valor.nombre + '</a> > ';
			});	
			$(div).append("<span class=\"list-group-item-action list-group-item  list-group-item  active\">"+sit+"</span>");
		}
		$.each( cat, function( key, val ) {
			$(div).append( "<a href=\"#\" class=\"linkCat list-group-item list-group-item-action\" data-id='" + val.id + "'>" + val.nombre + "</a>" );
		});
		$('.active').focus(); 
	});
}