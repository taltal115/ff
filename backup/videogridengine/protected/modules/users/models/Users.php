<?php

Yii::import('application.modules.users.models._base.BaseUsers');

class Users extends BaseUsers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function validatePasswordWP($password)
    {
             if($password===$this->user_pass);
        return true;
    }
}