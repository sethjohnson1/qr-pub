<?
/*
for getting the scorecard totals
*/
App::uses('Component', 'Controller');
class ScorecardComponent extends Component {

public $components = array('Cookie');
	
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
			//how to load model on Component (very handy!)
			$model=ClassRegistry::init('Scorecard');
			
			//first add Cookie variable to user data them remove it
			$cookie=$this->Cookie->read('counts');
			//array lends itself to nice nested loop
			if (isset($cookie)){
				foreach ($cookie as $key=>$val){
					foreach ($val as $id=>$true){
						$scoredata['id']=$userid.'_'.$id;
						$scoredata['location']=$key;
						if ($model->save($scoredata)){}
					}
				}
				//get rid of Cookie so this only happens once
				$this->Cookie->delete('counts');
			}
			
			//this is the save that occurs as the visit stuff (normal save)
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
		//use Cookie variables if no logged on user
			//first write the cookie, using the ID of the template to prevent double-counting
			if (isset($template['Template']['id'])) $this->Cookie->write(
			'counts.'.$template['Template']['location'].'.'.$template['Template']['id'], true);
			$totals['counts']=$this->Cookie->read('counts');
			$totals['counts']['BBM']=count($this->Cookie->read('counts.BBM'));
			$totals['counts']['CFM']=count($this->Cookie->read('counts.CFM'));
			$totals['counts']['DMNH']=count($this->Cookie->read('counts.DMNH'));
			$totals['counts']['PIM']=count($this->Cookie->read('counts.PIM'));
			$totals['counts']['WG']=count($this->Cookie->read('counts.WG'));
			$totals['counts']['HMRL']=count($this->Cookie->read('counts.HMRL'));
			$totals['counts']['Garden']=count($this->Cookie->read('counts.Garden'));
			$totals['counts']['NW']=count($this->Cookie->read('counts.NW'));
		}
		//for now we don't want to count "Nowhere"
		unset($totals['totals']['NW']);
		unset($totals['counts']['NW']);
		return $totals;
	}
}