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
		$conds=array('Template.active'=>1,'Template.previd is null');
		$totals['totals']['BBM']=$model->find('count',array('conditions'=>array('Template.location'=>'BBM',$conds)));
		$totals['totals']['CFM']=$model->find('count',array('conditions'=>array('Template.location'=>'CFM',$conds)));
		$totals['totals']['DMNH']=$model->find('count',array('conditions'=>array('Template.location'=>'DMNH',$conds)));
		$totals['totals']['PIM']=$model->find('count',array('conditions'=>array('Template.location'=>'PIM',$conds)));
		$totals['totals']['WG']=$model->find('count',array('conditions'=>array('Template.location'=>'WG',$conds)));
		$totals['totals']['HMRL']=$model->find('count',array('conditions'=>array('Template.location'=>'HMRL',$conds)));
		$totals['totals']['Garden']=$model->find('count',array('conditions'=>array('Template.location'=>'Garden',$conds)));
		$totals['totals']['NW']=$model->find('count',array('conditions'=>array('Template.location'=>'NW',$conds)));
		if (isset($userid)) {
			$model=ClassRegistry::init('Scorecard');
			if (isset($template['Template']['id'])){
				//combine user_id and template to make a unique identifier (but also cannot be counted over and over)
				$scoreid=$userid.'_'.$template['Template']['id'];
				$scoredata['id']=$scoreid;
				$scoredata['location']=$template['Template']['location'];
				if ($model->save($scoredata)){
					//yay it worked
				}
			}
			//now count the totals (even if no Template id)
			$totals['counts']['BBM']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'BBM')));
			$totals['counts']['CFM']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'CFM')));
			$totals['counts']['DMNH']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'DMNH')));
			$totals['counts']['PIM']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'PIM')));
			$totals['counts']['WG']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'WG')));
			$totals['counts']['HMRL']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'HMRL')));
			$totals['counts']['Garden']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'Garden')));
			$totals['counts']['NW']=$model->find('count',array('conditions'=>array("Scorecard.id LIKE '".$userid."_%'",'Scorecard.location'=>'NW')));
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
			$totals['counts']['NW']=count($this->Session->read('counts.NW'));
		}
		//for now we don't want to count "Nowhere"
		unset($totals['totals']['NW']);
		unset($totals['counts']['NW']);
		return $totals;
	}
}