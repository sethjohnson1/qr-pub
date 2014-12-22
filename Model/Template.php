<?php
App::uses('AppModel', 'Model');

class Template extends AppModel {

	public function beforeSave($options=array()){
		if(!empty($this->data['Template']['nextid'])){
			$prev=$this->find('first',array('conditions'=>array('Template.id'=>$this->data['Template']['nextid'])));
			//check that creator names match (which covers also whether or not the record exists)
			if($prev['Template']['creator']==$this->data['Template']['creator']){		
				$savedata['id']=$prev['Template']['id'];
				$savedata['previd']=$this->data['Template']['id'];
				//this is how to save from the Model
				$template=new Template();
				$template->create();
				$template->set($savedata);
				if ($template->save()) return true;
				else return false;
			}
			//lazy no error checking, but moving on
			else return false;
		}
		
		$this->data['Template']['ip'] = $_SERVER["REMOTE_ADDR"];
		
		//generate a code if its empty, which is should usually be except for the whitney thing where we want to reuse the AcoustiGuide codes
		if (empty($this->data['Template']['code'])){
			$last=$this->find('first',array('order'=>array('code'=>'DESC')));
			$this->data['Template']['code'] = $last['Template']['code']+1;
		}

		//this should be return TRUE, but false for testing
		return true;
			
	}
	


	public $hasMany = array(
		'Asset' => array(
			'className' => 'Asset',
			'foreignKey' => 'template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Beacon' => array(
			'className' => 'Beacon',
			'foreignKey' => 'template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
