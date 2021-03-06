<?php

/**
 * This is the model base class for the table "wp_foundbox".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Foundbox".
 *
 * Columns in table "wp_foundbox" available as properties of the model,
 * followed by relations of table "wp_foundbox" available as properties of the model.
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $privacy
 * @property string $widget_thumb_url
 * @property string $date_created
 * @property string $date_modified
 * @property integer $average_rank
 * @property integer $status
 * @property string $wp_users_ID
 *
 * @property Users $wpUsers
 * @property Foundboxvideos[] $foundboxvideoses
 */
abstract class BaseFoundbox extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'wp_foundbox';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Foundbox|Found Boxes', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, description, widget_thumb_url,average_rank', 'required'),
			array('privacy, status', 'numerical', 'integerOnly'=>true),
			array('title, widget_thumb_url', 'length', 'max'=>250),
			array('wp_users_ID', 'length', 'max'=>20),
			array('privacy, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, description, privacy,average_rank, widget_thumb_url, date_created, date_modified, status, wp_users_ID', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'wpUsers' => array(self::BELONGS_TO, 'Users', 'wp_users_ID'),
			'foundboxvideoses' => array(self::HAS_MANY, 'Foundboxvideos', 'ff_foundboxes_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'privacy' => Yii::t('app', 'Privacy'),
			'widget_thumb_url' => Yii::t('app', 'Widget Thumb Url'),
			'date_created' => Yii::t('app', 'Date Created'),
			'date_modified' => Yii::t('app', 'Date Modified'),
                        'average_rank' => Yii::t('app', 'Average Rank'),
			'status' => Yii::t('app', 'Status'),
			'wp_users_ID' => null,
			'wpUsers' => null,
			'foundboxvideoses' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
                    
                //if user is login get his only
                
		$criteria->compare('id', $this->id, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('privacy', $this->privacy);
		$criteria->compare('widget_thumb_url', $this->widget_thumb_url, true);
		$criteria->compare('date_created', $this->date_created, true);
		$criteria->compare('date_modified', $this->date_modified, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('average_rank', $this->average_rank);
                if(Yii::app()->user->name=="admin")
                $criteria->compare('wp_users_ID', $this->wp_users_ID);
                else
                $criteria->compare('wp_users_ID',Yii::app()->user->id) ;
    

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
        public function searchFoundBoxesByTitle() {
		
              $results = array();  
            
                $criteria = new CDbCriteria;
                 
                
                $criteria->compare('title', $this->title, true);
		
		$criteria->compare('privacy', $this->privacy);
		
            
//            foreach($this->findAll($criteria) as $m)
//            {
//                $results[] = $m->title;//{$this->title};
//            }
//
//		return $results;
                return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
        
         public function searchFoundBoxessuggestions() {
		
              $results = array();  
            
                $criteria = new CDbCriteria;
                 
                
                $criteria->compare('title', $this->title, true);
		
		$criteria->compare('privacy', $this->privacy);
		
            
            foreach($this->findAll($criteria) as $m)
            {
                $results[] = $m->title;//{$this->title};
            }

		return $results;
//                return new CActiveDataProvider($this, array(
//			'criteria' => $criteria,
//		));
	}
}