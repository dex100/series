<?php 
// $correlativo = $ucons['Constancia']['correlativo'];
// $correlativo += 1;
// echo str_pad($correlativo, 5, "0", STR_PAD_LEFT); 
// echo '<p>' . Inflector::singularize( 'cars' ) . '</p>'; # prints "Pois"
// echo '<p>' . Inflector::pluralize( 'car' ) . '</p>';   

// echo $this->Html->link("Agregar Serie", array('action' => 'add', $estado));

/* <br>
// <table>
	// <tr>
		// <td><?php echo $this->Html->link("Viendo", array('action' => 'index', 'viendo')); ?></td>
		// <td><?php echo $this->Html->link("En Espera", array('action' => 'index', 'espera')); ?></td>
		// <td><?php echo $this->Html->link("Por Ver", array('action' => 'index', 'ver')); ?></td>
		// <td><?php echo $this->Html->link("Completados", array('action' => 'index', 'completado')); ?></td>
		// <td><?php echo $this->Html->link("Descargando", array('action' => 'index', 'descargando')); ?></td>
		// <td><?php echo $this->Html->link("Todos", array('action' => 'index', 'todo')); ?></td>
	// </tr>
// </table>
// <br>
// <br>
*/
?>
 
<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista">
<thead>
	<tr>
		<th>Nombre</th>
		<th>Progreso</th>
		<th>Descarga</th>
		<th>Fecha Inicio</th>
		<th>Fecha Fin</th>
		<th>Tipo</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($listado as $serie): ?>
		<tr>
			<td><?php echo $this->Html->link($serie['Series']['nombre'], array('action' => 'edit', $serie['Series']['id'], $estado)); ?></td>
			<td>
				<?php 
					if ($serie['Series']['total'] == '') {
						$total = '-';
					} else {
						$total = $serie['Series']['total'];
					}	    
					if ($serie['Series']['progreso'] == '') {
						$progreso = '-';
					} else {
						$progreso = $serie['Series']['progreso'];
					}

					echo '<span class="edit" id="'.$serie['Series']['id'].'">'.$progreso.'</span>/'.$total.'   '
							.$this->Js->link('+', array('controller' => 'series', 'action' => 'up', $serie['Series']['id']),
							array('success' => "var datos = JSON.parse(data); $('#".$serie['Series']['id']."').html(datos.progreso); 
								$('#d_".$serie['Series']['id']."').html(datos.descarga);") ); 
					echo $this->Js->writeBuffer();
				?>
			</td>
			<td>
				<?php 
					if ($serie['Series']['total'] == '') {
						$total = '-';
					} else {
						$total = $serie['Series']['total'];
					}
					if ($serie['Series']['descarga'] == '') {
						$descarga = '-';
					} else {
						$descarga = $serie['Series']['descarga'];
					}	    

					echo '<span class="dl" id="d_'.$serie['Series']['id'].'">'.$descarga.'</span>/'.$total.'   '.$this->Js->link('+', array('controller' => 'series', 'action' => 'upd', $serie['Series']['id']), array('update'=>'#d_'.$serie['Series']['id']) ); 
					echo $this->Js->writeBuffer();
				?>
			</td>
			<td><?php echo $serie['Series']['fini']; ?></td>
			<td><?php echo $serie['Series']['ffin']; ?></td>
			<td><?php 
					$tipo = $serie['Series']['tipo'];
					if ($tipo == 'serie') {
						$tipo = 'serie TV';
					}
					echo ucfirst($tipo); 
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php unset($listado); ?>
</tbody>
</table>
