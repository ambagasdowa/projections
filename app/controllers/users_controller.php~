<?php
class UsersController extends AppController {
    var $name = 'Users';
    var $components = array('RequestHandler','Session');
    var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf','GChart');
    var $paginate = array(
        'User' => array(
            'limit' => 20,
			'conditions'=>array('status'=>'Active'),
            'order' => array(
                'User.full_name' => 'asc',
            ),
        ),
    );
    var $uses = array('User','Empresas','Themes');
    
    /**
     * Set this to false if you don't want to store clear passwords in the database
     * @var bool
     * @access private
     */
    var $_store_clear_password = true;
//     var $helpers = array('Pdf');
      
    function crea_pdf()
    {
        Configure::write('debug',0);
        $this->layout = 'pdf';
        $this->render();
    }	
    
    function index(){
        $users = $this->paginate('User');
        $this->set(compact('users'));
        if(isset($_SESSION['Auth']['User']['chpass'])){
		  $this->redirect('../projections/');
		}
    }

    function egg(){
        if($this->Auth->user()['User']['id'] == '1'){
		  $this->render($this->Auth->user()['User']['username']);
		}else{
		  $this->Session->setFlash('Bye!!');
		  $this->redirect($this->Auth->logout());//getout of hir!!
		}
	}
	
	function getLevel(){
	  	$authUsers = array('0' => 'Administrador',
						   '2' => 'Atm-Tbk',
						   '3' => 'Teisa-Tbk',
						   '7' => 'Usuario');

		$status = array('Active' => 'Activo', 'Inactive' => 'Inactivo');

		$this->set('authUsers',$authUsers);
		$this->set('status',$status);
	}
	
	function ShiftCorporation($return=null ,$set=null){
// 		pr($this->data);
// 		define if this comes from db ??
// 		anyway
// 		0 => superCowPowers
// 		2 => tbk-atm
// 		3 => tbk-teisa
// 		7 => human
		$empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa')));
		if($this->data['User']['level'] == '0'){
		  $empresas['0'] = 'Todas';
		}if($this->data['User']['level'] == '7'){
		  unset($empresas['4']);
		}if($this->data['User']['level'] == '2' OR $this->data['User']['level'] == '3'){
		  foreach($empresas as $idxEmpresa => $empresa){
			if($idxEmpresa < '4'){
			  unset($empresas[$idxEmpresa]);
			}
		  }
		}

		if($return == false and $set == true){
		  $this->set('empresas',$empresas);
		}elseif($return == true and $set == false){
		  return $empresa;
		}elseif($return == false and $set == false){
		  $this->set('empresas',$empresas);
		}else{
		  $this->redirect($this->Auth->logout());//getout of hir!!
		}
	}//End ShiftCorporation
	
    function add($id=null){

        if(isset($_SESSION['Auth']['User']['chpass'])){
		  $this->redirect('../projections/');
		}
		if( $_SESSION['Auth']['User']['level'] == '0' OR ($_SESSION['Auth']['User']['level'] > 0 and isset($_SESSION['Auth']['User']['chpass'])) ){

			if(!empty($this->data) and empty($id)){
				$this->User->set($this->data);
				if($this->User->validates()){
					/** @isn't->obvious??XDXD */
					$this->data['User']['password'] = $this->data['User']['clear_password'];
					/** @package => password -> add a field password with the clear_password from the POST hashed as value */
					$this->data = $this->Auth->hashPasswords($this->data);

// 	            pr($this->Auth->hashPasswords($this->data));
					if (!$this->_store_clear_password)
					{
						unset($this->data['User']['clear_password']);
					}
// 				pr($this->data);exit();
	                $this->User->save($this->data, false);
					$this->Session->setFlash('<div id="warning"><span>User Added</span></div>');
	                $this->redirect('index');
				}
			}
			$this->getLevel();
		}else{
		  $this->redirect($this->Auth->logout());//getout of hir!!
		}
    }//End add
    
    function edit($id = null) {
	  /** @from->hir  WARNING And then Again
	    * @if id=>empty
	    */
        if (!empty($this->data)) {
            $fields = array_keys($this->data['User']);
            if (!empty($this->data['User']['clear_password']) || !empty($this->data['User']['confirm_password'])) {
                $fields[] = 'password';
            } else {
                $fields = array_diff($fields, array('clear_password', 'confirm_password'));
            }
            $this->User->set($this->data);
            if ($this->User->validates()) {
                if (!empty($this->data['User']['clear_password'])) {
                    $this->data['User']['password'] = $this->data['User']['clear_password'];
                }
                $this->data = $this->Auth->hashPasswords($this->data);
                if (!$this->_store_clear_password) {
                    unset($this->data['User']['clear_password']);
                }
                $this->User->save($this->data, false, $fields);
                $this->Session->setFlash('<div id="warning"><span>User Updated</span></div>');
                if(isset($this->data['User']['chpass'])){
// 				  $this->redirect('edit/'.$id);
				  if($_SESSION['Auth']['User']['level'] == '0' and isset($_SESSION['Auth']['User']['chpass'])){
					unset($_SESSION['Auth']['User']['chpass']);
				  }
				  $this->redirect('../');
				}else{
// 				  if($_SESSION['Auth']['User']['level'] == '0' and isset($_SESSION['Auth']['User']['chpass'])){
// 					unset($_SESSION['Auth']['User']['chpass']);
// 				  }
				  $this->redirect('index');
				}
            }
         /** @to->hir */
        } else {
            $user = $this->User->findById($id);
            $empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa')));
            $empresas[0] = 'Todas';

            if(empty($user)){
                $this->Session->setFlash('Invalid User ID', 'flash_notice');
                $this->redirect('add');
            /** @then->hir */
            }else{
                unset($user['User']['clear_password']);
                $this->data = $user;
            }

			if(!empty($id)){
			  if(isset($this->data['User']['chpass'])){
				$_SESSION['Auth']['User']['chpass'] = $this->data['User']['chpass'];
			  }
			  $this->set('edit',true);
			  $this->set('empresa',$empresas[$user['User']['id_empresa']]);
			  $this->getLevel();
			}
            $this->render('add');
        }
    } // end Function
    
    function delete() {
        $delete_count = 0;
        if (!empty($this->data['User']['delete'])) {
            foreach($this->data['User']['delete'] as $id => $delete) {
                if ($delete == 1) {
                    if ($this->User->delete($id)) {
                        $delete_count++;
                    }
                }
            }
        }
        $this->Session->setFlash($delete_count . ' User' . (($delete_count == 1) ? ' was' : 's were') . ' deleted');
        $this->redirect('index');
    }
    
    function login() {

	  $empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa')));
	  $this->set('empresas',$empresas);
	  $themes = $this->Themes->find('all');
		// reset $_SESSION['theme']
// 		$_SESSION['theme'] = null;
	  $group = 'Themes.default';
	  $defaultTheme = $this->Themes->find('all',array('fields'=>array('id_theme','library','default'),'group'=>$group));
	  foreach($defaultTheme as $idArrTheme => $dataThemes ) {
		  foreach($dataThemes as $themeContent => $libraryThemes) {
			  if(!isset($_SESSION['theme'][$libraryThemes['library']])) {
				  $_SESSION['theme'][$libraryThemes['library']] = null;
			  }
			  if($libraryThemes['default'] == true) {
				  $_SESSION['theme'][$libraryThemes['library']] = true;
			  } else {
				  $_SESSION['theme'][$libraryThemes['library']] = false;
			}
		}
	  }

		if (!empty($this->data) && $this->Auth->user()){
            $this->User->id = $this->Auth->user('id');
            /** NOTE @theme selection*/
		    $themeConditions['Themes.id_theme'] = $this->Auth->user('id_theme');
			$theme = $this->Themes->find('list',array('fields'=>array('id_theme','library'),'conditions'=>$themeConditions));
			$tema = array_fill_keys(array_keys($_SESSION['theme']),false); //set the array elements to zero
			$_SESSION['theme'] = $tema; //rewrite the session variable
			$themeKey = array_values($theme)['0']; //extract the values of the theme form the user config
			/** fill the session theme variable whit the user config */
			if( array_key_exists($themeKey,$tema) === true ) {
				$_SESSION['theme'][$themeKey] = true;
			}
		   /** NOTE @Enterprise selection*/
		  if($this->Auth->user()['User']['id_empresa'] === '0'){
			//this data comes from the db as auth param means all empresas because any empresa is defined
			
			  /** @set the Empresa with to work and
			   *  @Anti-Hacker condition
			   *  @Search all empresas and compare the login empresa selection with the exixsting in db
			   */
			  $conditions['Empresas.id_empresa'] = $this->data['User']['id_empresa'];
			  $emp = $this->Empresas->find('first',array('conditions'=>$conditions));

			  /** @if->id_empresa is greater than 3 is because have another enterprise and for now his status is zero and
			   * @important is the unique with this, anyway now this is GST as an other
			   * @important corporation  but maybe this must change in the future
			   * ALERT so listen Ambagasdowa from the future,then the condition
			   * ALERT must be $this->data['User']['id_empresa'] XDXD!!
			   */
// 			  if the selected empresa is inactive is because for the moment is GST
			  if($emp['Empresas']['active'] === '0' /*and $this->data['User']['level'] === '0'*/){
				/** ALERT So appear to be GST with @superCowPowers build a backup */
				$_SESSION['Auth']['User']['id_empresa_back'] = $this->data['User']['id_empresa'];
				$_SESSION['Auth']['User']['empresa_back'] = $emp['Empresas']['empresa'];
				// Ok now go
				$_SESSION['Auth']['User']['id_empresa'] = $this->data['User']['id_empresa'];
				$_SESSION['Auth']['User']['empresa'] = $emp['Empresas']['empresa'];
				
			  }else{ // any other selection go as normal login
				$_SESSION['Auth']['User']['id_empresa'] = $this->data['User']['id_empresa'];
				$_SESSION['Auth']['User']['empresa'] = $emp['Empresas']['empresa'];
			  }
			  $this->redirect('/');

			  
		  }if($this->Auth->user()['User']['id_empresa'] === '4'){
				  $corp = $this->Empresas->getEmpresas();
				  if($this->Auth->user()['User']['level'] === '2'){
					  $_SESSION['Auth']['User']['id_empresa'] = $_SESSION['Auth']['User']['level'];
					  $_SESSION['Auth']['User']['empresa'] = $corp[$_SESSION['Auth']['User']['level']];
				  }elseif($this->Auth->user()['User']['level'] === '3'){
					  $_SESSION['Auth']['User']['id_empresa'] = $_SESSION['Auth']['User']['level'];
					  $_SESSION['Auth']['User']['empresa'] = $corp[$_SESSION['Auth']['User']['level']];
				  }else{
					$this->redirect($this->Auth->logout());//getout of hir!!
				  }
				$this->redirect('/');

		  }elseif($this->Auth->user()['User']['id_empresa'] < '4'){
			$conditions['Empresas.id_empresa'] = $this->data['User']['id_empresa'];
			$emp = $this->Empresas->find('first',array('conditions'=>$conditions));
			
			/** @go-away->Quaker */
			if($emp['Empresas']['id_empresa'] !== $this->Auth->user()['User']['id_empresa']){
			unset($_SESSION['DATA_CIA']);
			$this->redirect($this->Auth->logout());
			
			}else{ /** @appear this is never executing XD ! */
				$_SESSION['Auth']['User']['id_empresa'] = $this->data['User']['id_empresa'];
				$_SESSION['Auth']['User']['empresa'] = $emp['Empresas']['empresa'];
				$this->redirect('/');
			}
		  }else{ // End all-mighty
			$this->redirect($this->Auth->logout());//getout of hir!!
		  }
        } // End if
    } // End function login();

    function logout(){
		foreach($_SESSION as $container => $arrayContainer){
		  if($container !== 'Auth' AND $container !== 'Config' AND $container !== 'Message'){//Belong to normal Session
		  unset($_SESSION[$container]); // Sanitize the Global var $_SESSION
		  }
		}
        $this->redirect($this->Auth->logout());
    }

}
?>
