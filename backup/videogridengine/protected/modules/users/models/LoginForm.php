<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
        
        /**
     *
     * @return UserIdentity
     */
    private $_identity;
        public $currentUser; //Object of WP USER

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
        /**
         * if user is login from wordpress it shud get login automatical
         * if user is already login so we should not proceed its login method again
         * 
         */
        public function verifyUser() {
//            var_dump(Yii::app()->user->isGuest);
//             print_r(Yii::app()->user->name);
//             print_r(Yii::app()->user->id);
        if (Yii::app()->user->isGuest) //USER IS NOT LOGIN in YIIFramework 
            {
                //now check maybe  user is login in wordpress
                if(is_user_logged_in())
                {
                   
                    if($this->autoLoginWP())// if user would get login auto matically
                    {
                     //    echo "login is done";
                        if(is_user_admin())
                        {
                            
                                //set user type as ADMIN
                            $this->_identity->setAdmin(true);
                            
                        }
                    }
                    else {
                            //user has failed with auto login ..
                            //redirect user to login form
                        $this->redirect(get_site_url() . '/wp-login.php');
                        
                    }
                      //Now as user is alrey logged in wp so make him login in yii also  
                    
                }
                    
                //check if user is login in wordpress then set him autologin
        }
        else
        {
            //if user is not logged in in wordpress lgout from yii too
            
            if(!is_user_logged_in())
            {
             Yii::app()->user->logout();   
            }
            
        }
    }
    public function setCurrentUser($currentUser) {
        
        $this->currentUser=$currentUser;
                
    }
    public function autoLoginWP()
    {
        $current_user = wp_get_current_user();
        $this->setCurrentUser($current_user);
        $this->username=$current_user->user_login;
        $this->password=$current_user->user_pass;
        $isLogin=$this->login();
        return $isLogin;
        
    }
}
