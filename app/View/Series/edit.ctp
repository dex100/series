<h1>Editar Series</h1>
<?php
setlocale(LC_TIME, "spanish");
echo $this->Form->create('Series');
echo $this->Form->input('nombre', array('autofocus' => 'autofocus'));
echo $this->Form->input('total');
echo $this->Form->input('progreso');
echo $this->Form->input('descarga');
echo $this->Form->input('fini', array('label' => 'Fecha Inicio', 'type' => 'text', 'class' => 'datepicker'));
echo $this->Form->input('ffin', array('label' => 'Fecha Fin', 'type' => 'text', 'class' => 'datepicker'));
echo $this->Form->input('estado', array('options' => array('viendo' => 'Viendo', 'espera' => 'En Espera', 'ver' => 'Por Ver', 'completado' => 'Completado', 'descargando' => 'Descargando', 'eliminado' => 'Eliminado')));
echo $this->Form->input('tipo', array('options' => array('serie' => 'Serie TV', 'webtoon' => 'Webtoon', 'anime' => 'Anime', 'manga' => 'Manga')));
echo $this->Form->end('Actualizar');
?>