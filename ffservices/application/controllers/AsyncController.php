<?php
/**
 * Description of AsyncController
 *
 * @author jon
 */
class AsyncController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();



	}


	public function getitemsAction()
	{

		echo Zend_Json_Encoder::encode($this->generateItems());
	}

	public function getitemAction()       
	{
		$id = $this->getRequest()->getParam('itemId');
		$items = $this->generateItems();

		echo Zend_Json_Encoder::encode($items[$id]);
	}


	private function generateItems()
	{
		$items = array();
		for ($i = 0; $i < 5; $i++)
		{
			$newItem = new App_ItemDto();

			$newItem->name =   substr(md5(uniqid()) , 0 , rand(7, 9)) . " " .   substr(md5(uniqid()) , 0 , rand(0, 4));
			$newItem->description = "this is a description";
			$newItem->id = $i;

			$items[] = $newItem;
		}
		return $items;
	}
}