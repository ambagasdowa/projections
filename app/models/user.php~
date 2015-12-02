<?php
class User extends AppModel {
    var $name = 'User';
    var $virtualFields = array(
        'full_name' => "CONCAT(User.first_name, ' ', User.last_name)",
    );
    var $recursive = 2;
    var $useDbConfig ='login';
      
    var $validate = array(
        'username' => array(
            'empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
//                 'message' => 'Username is required',
				'message' => 'El nombre de Usuario es Requerido',
            ),
            'minlength' => array(
                'rule' => array('minLength', 4),
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'Usernames must be at least 4 characters long',
				'message' => 'El nombre de Usuario debe contener al menos 4 caracteres de longitud',
            ),
            'maxlength' => array(
                'rule' => array('maxLength', 20),
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'Usernames may not be more than 20 characters long',
				'message' => 'El nombre de Usuario no debe sobrepasar los 20 caracteres de longitud',
            ),
//             'alphanum' => array(
//                 'rule' => 'alphaNumeric',
//                 'required' => true,
//                 'allowEmpty' => true,
// //                 'message' => 'Usernames may only contain letters and numbers',
// 				'message' => 'El nombre de Usuario solo puede contener letras y números',
//             ),
            'alphaNumericDashUnderscoreDoth' => array(
                'rule' => 'alphaNumericDashUnderscoreDoth',
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'Usernames may only contain letters and numbers',
				'message' => 'El nombre de Usuario solo puede contener letras ,números, guiones y puntos',
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'That username is already in use',
				'message' => 'Este Usuario ya existe',
            ),
        ),
        'clear_password' => array(
            'empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'on' => 'create',
//                 'message' => 'Password is required',
				'message' => 'Contraseña Obligatoria',
            ),
            'length' => array(
                'rule' => array('minLength', 6),
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'Passwords must be at least 6 characters long',
				'message' => 'La Contraseña debe contener al menos 6 caracteres de longitud',
            ),
        ),
        'confirm_password' => array(
            'empty_create' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'on' => 'create',
//                 'message' => 'Please confirm the password 1',
                'message' => 'Confirmar Contraseña',
            ),
            'empty_update' => array(
                'rule' => 'validateConfirmPasswordEmptyUpdate',
                'required' => true,
                'allowEmpty' => true,
                'on' => 'update',
//                 'message' => 'Please confirm the password 2',
				'message' => 'Confirmar Contraseña en el segundo campo',
            ),
            'match' => array(
                'rule' => 'validateConfirmPasswordMatch',
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'The passwords do not match',
				'message' => 'Las contraseñas son diferentes',
            ),
        ),
        'email' => array(
            'empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
//                 'message' => 'Email is required',
				'message' => 'Indique una direccion de correo electronico',
            ),
            'valid' => array(
                'rule' => 'email',
                'required' => true,
                'allowEmpty' => true,
//                 'message' => 'Please enter a valid email address',
				'message' => 'Por favor indique una direccion de correo valida',
            ),
        ),//This is not needed if use another app
        'id_empresa' => array(
            'empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'El campo Empresa es requerido',
            ),
        )
    );
    
    /**
     * Callback function for confirm_password
     * Used to check the confirm_password field is not empty on update
     * @return bool
     */
    function validateConfirmPasswordEmptyUpdate() {
        return !empty($this->data['User']['clear_password']) && !empty($this->data['User']['confirm_password']);
    }
    
    /**
     * Callback function for confirm_password
     * Used to check if clear_password and confirm_password match
     * @return bool
     */
    function validateConfirmPasswordMatch() {
        return $this->data['User']['clear_password'] == $this->data['User']['confirm_password'];
    }
    
    function alphaNumericDashUnderscoreDoth($check) {
      // $data array is passed using the form field name as the key
      // have to extract the value to make the function generic
      $value = array_shift($check);

      return preg_match('|^[0-9a-zA-Z_.]*$|', $value);
    }
}
?>
