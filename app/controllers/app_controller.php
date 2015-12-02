<?php
class AppController extends Controller {
    var $components = array(
        'Auth' => array(
            'autoRedirect' => false,
        ),
        'Session',
    );
    var $helpers = array(
        'Html',
        'Form',
        'Session',
        'Ajax',
    );
    /*function beforeFilter()
    {
       parent::beforeFilter();
       $this->Auth->allow(array('*'));   
    }*/

	function export_xls($data=null, $titulo, $filename='Reporte',$element=null) {
/** @Description
 * 	@package
 * 	@issues => firts versions works for the output of $this->model->find(); data or 1 dimension11 array
 *  @Readme => adding support for multidimensional arrays firts example is static
 * 	@element => switch for render the view of data
 **/
			$this->set('rows',$data);
	        $this->set('titulo',$titulo);
	        $this->set('filename',$filename);
	        if(!isset($element)){
			  $element = 'export_xls';
			}
			$this->render('/elements/'.$element,$element);
	}// end function


    function afterFilter()
    {
        # Update User last_access datetime
        if ($this->Auth->user())
        {
            $this->loadModel('User');
            $this->User->id = $this->Auth->user('id');
            $this->User->saveField('last_access', date('Y-m-d H:i:s'));
        }
    }
    
    // fetch the themes conf from DB
    function beforeFilter() {
        if ($this->Auth->user()) {
            $this->loadModel('Themes');
            $themeConditions['Themes.status'] = 'Active';
            $tema = $this->Themes->find('all',array('fields'=>array('id_theme','themename','library','version'),'conditions'=>$themeConditions));
			$_SESSION['tema'] = $tema;
        }
	}
    
}
?>
