<?php
class SeriesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Js');
    public $components = array('Session', 'RequestHandler');	

	
    public function index($estado = "viendo") {
		$this->layout = 'inicio';
		if ($estado == 'todo') {
			$this->set('listado', $this->Series->find('all'));	
		} else {
			$this->set('listado', $this->Series->find('all', array(	'conditions' => array('Series.estado' => $estado))));	
		}
		$this->set('estado', $estado);
    }

	
	public function add($estado) {
		$this->layout = 'inicio';
		if ($this->request->is('post')) {	
			$this->Series->create();
			// if ($this->request->data['Series']['estado'] == 'viendo') {	        
			// 	$this->Series->set('fini', date("Y-m-d"));
			// }
			if ($this->request->data['Series']['estado'] == 'completado') {
				$this->Series->set('ffin', date("Y-m-d"));
			}

			// $this->Session->setFlash(print_r($this->request->data));
			if ($this->Series->save($this->request->data)) {
				$this->Session->setFlash('Serie agregada.', 'default', array('class' => 'notice success'));		
				$this->redirect(array('action' => 'index', $estado));
			} else {
				$this->Session->setFlash('Error al agregar.');
			}
		}
		$this->set('estado', $estado);
	}
    
	public function up($id) {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->Series->id = $id;
			$serie = $this->Series->findById($id);
			$progreso = $serie['Series']['progreso'] + 1;
			$descarga = $serie['Series']['descarga'];
			$this->Series->saveField('progreso', $progreso);
			$tipo = $serie['Series']['tipo'];
			if ($tipo == 'serie' && $serie['Series']['progreso'] == $descarga) {
				$descarga = $progreso;
				$this->Series->saveField('descarga', $progreso);
			}
			if ($descarga == '') {
				$descarga = '-';
			}
			if ($progreso == $serie['Series']['total']) {
				$this->Series->saveField('estado', 'completado');
				$this->Series->saveField('ffin', date("Y-m-d"));
			}
			$datos = array('progreso' => $progreso, 'descarga' => $descarga);
			return json_encode($datos);
//			$this->set('datos', $datos);		
//			$this->render('update', 'ajax');
		}
	}
	
	 public function update() {
        if ($this->data) {
			$this->autoRender = false;
			$nuevo = $this->data['Series']['progreso'];
            $this->Series->id = $this->data['Series']['id'];
			$serie = $this->Series->findById($this->data['Series']['id']);
			$descarga = $serie['Series']['descarga'];
            $this->Series->saveField('progreso', $nuevo);
			if ($serie['Series']['tipo'] == 'serie' && $nuevo > $descarga) {
				$descarga = $nuevo;
				$this->Series->saveField('descarga', $nuevo);
			}
			if ($descarga == '') {
				$descarga = '-';
			}
			if ($nuevo == $serie['Series']['total']) {
				$this->Series->saveField('estado', 'completado');
				$this->Series->saveField('ffin', date("Y-m-d"));
			}
			$datos = array('id' => $this->data['Series']['id'], 'progreso' => $nuevo, 'descarga' => $descarga);
			return json_encode($datos);
//            $this->set('serieprogreso', $nuevo);
//			$this->render('up', 'ajax');
        }
    }
	
	public function upd($id) {
		if ($this->request->is('ajax')) {
			$this->Series->id = $id;		
			$serie = $this->Series->findById($id);			
			$descarga = $serie['Series']['descarga'] + 1;
			$tipo = $serie['Series']['tipo'];
			$this->Series->saveField('descarga', $descarga);        	
			if ($tipo == 'anime' && $descarga == $serie['Series']['total']) {
				$this->Series->saveField('estado', 'completado');
			}		
			$this->set('serieprogreso', $descarga);
			$this->render('up', 'ajax');
		}
	}
	
	 public function updated() {
        if ($this->data) {
			$nuevo = $this->data['Series']['descarga'];
			$did = explode("_", $this->data['Series']['id']);
            $this->Series->id = $did[1];			
            $this->Series->saveField('descarga', $nuevo);	
$serie = $this->Series->findById($did[1]);
$tipo = $serie['Series']['tipo'];	
if ($tipo == 'anime' && $nuevo == $serie['Series']['total']) {
				$this->Series->saveField('estado', 'completado');
			}	
            $this->set('serieprogreso', $nuevo);
			$this->render('up', 'ajax');
        }
    }
	
	public function edit($id = null, $estado) {
		$this->layout = 'inicio';
		$this->Series->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Series->read();
		} else {
			// if ($this->request->data['Series']['estado'] == 'viendo') {	        
			// 	$this->Series->set('fini', date("Y-m-d"));
			// }
			if ($this->request->data['Series']['estado'] == 'completado') {
				$this->Series->set('ffin', date("Y-m-d"));
			}
			if ($this->Series->save($this->request->data)) {
				$this->Session->setFlash('Serie actualizada.', 'default', array('class' => 'notice success'));
				$this->redirect(array('action' => 'index', $estado));
			} else {
				$this->Session->setFlash('Error al actualizar.');
			}
		}
		$this->set('estado', $estado);
	}
}