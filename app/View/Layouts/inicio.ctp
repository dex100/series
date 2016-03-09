<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>		
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('cake.generic', 'demo_table', 'style', 'jquery-ui'));
		echo $this->Html->script(array('jquery', 'jquery-ui.min', 'jquery.dataTables', 'jslistado', 'jquery.jeditable'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="page">
	<div id="header">
			<h1>MyList</h1>
			<div class="description">Listado de Series</div>
	</div>
	<div id="menulinks">
		<a <?php if($estado == 'viendo') echo 'class="active"'; ?> href="/series/series/index/viendo"><span>Viendo</span></a>	
		<div class="menulines"></div>
		<a <?php if($estado == 'descargando') echo 'class="active"'; ?> href="/series/series/index/descargando"><span>Descargando</span></a>	
		<div class="menulines"></div>
		<a <?php if($estado == 'espera') echo 'class="active"'; ?> href="/series/series/index/espera"><span>En Espera</span></a>		
		<div class="menulines"></div>
		<a <?php if($estado == 'ver') echo 'class="active"'; ?> href="/series/series/index/ver"><span>Por Ver</span></a>		
		<div class="menulines"></div>
		<a <?php if($estado == 'completado') echo 'class="active"'; ?> href="/series/series/index/completado"><span>Completados</span></a>			
		<div class="menulines"></div>
		<a <?php if($estado == 'todo') echo 'class="active"'; ?> href="/series/series/index/todo"><span>Todos</span></a>		
		<div class="menulines"></div>
	</div>
	<div id="mainarea">
	<div id="contentarea">
		<h2><?php echo $this->Html->link("Agregar Serie", array('action' => 'add', $estado));?></h2>
		<div class="content">
		
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>			
	</div>
	
	
	<div id="footer">
    
          
		<div id="footerleft">&copy; <?php echo date("Y"); ?>. Todos los derechos reservados. </div>
		<div id="footerright">Spock Bros.</div>
	</div>

</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>