<?
/*
for getting the scorecard totals
*/
App::uses('Component', 'Controller');
class ScorecardComponent extends Component {

public $components = array('Session');
	
	public function scoreTotals ($template, $userid){
		$totals=array();
		$model=ClassRegistry::init('Template');
		$totals['totals']['BBM']=$model->find('count',array('conditions'=>array('Template.location'=>'BBM')));
		$totals['totals']['CFM']=$model->find('count',array('conditions'=>array('Template.location'=>'CFM')));
		$totals['totals']['DMNH']=$model->find('count',array('conditions'=>array('Template.location'=>'DMNH')));
		$totals['totals']['PIM']=$model->find('count',array('conditions'=>array('Template.location'=>'PIM')));
		$totals['totals']['WG']=$model->find('count',array('conditions'=>array('Template.location'=>'WG')));
		$totals['totals']['HMRL']=$model->find('count',array('conditions'=>array('Template.location'=>'HMRL')));
		$totals['totals']['Garden']=$model->find('count',array('conditions'=>array('Template.location'=>'Garden')));
		if (isset($userid) && isset($template['Template']['id'])) {
			$model=ClassRegistry::init('Scorecard');
			//combine user_id and template to make a unique identifier (but also cannot be counted over and over)
			$scoreid=$userid.'_'.$template['Template']['id'];
			$scoredata['id']=$scoreid;
			$scoredata['location']=$template['Template']['location'];
			//$scoredata['user_id']=$user['id'];
			if ($model->save($scoredata)){
				$totals['counts']['BBM']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'BBM')));
				$totals['counts']['CFM']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'CFM')));
				$totals['counts']['DMNH']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'DMNH')));
				$totals['counts']['PIM']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'PIM')));
				$totals['counts']['WG']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'WG')));
				$totals['counts']['HMRL']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'HMRL')));
				$totals['counts']['Garden']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'Garden')));
			
			}
		}
		else {
		//use Session variables if no logged on user
			//first write the session, using the ID of the template to prevent double-counting
			//CakeSession::write('counts.'.$template['Template']['location'].'.'.$template['Template']['id'], true);
			if (isset($template['Template']['id'])) $this->Session->write(
			'counts.'.$template['Template']['location'].'.'.$template['Template']['id'], true);
			$totals['counts']=$this->Session->read('counts');
			$totals['counts']['BBM']=count($this->Session->read('counts.BBM'));
			$totals['counts']['CFM']=count($this->Session->read('counts.CFM'));
			$totals['counts']['DMNH']=count($this->Session->read('counts.DMNH'));
			$totals['counts']['PIM']=count($this->Session->read('counts.PIM'));
			$totals['counts']['WG']=count($this->Session->read('counts.WG'));
			$totals['counts']['HMRL']=count($this->Session->read('counts.HMRL'));
			$totals['counts']['Garden']=count($this->Session->read('counts.Garden'));
	
		}
		return $totals;
	}
}