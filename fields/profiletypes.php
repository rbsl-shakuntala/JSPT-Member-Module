<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once JPATH_ROOT.DS.'components'.DS.'com_xipt'.DS.'api.xipt.php';

class JFormFieldProfiletypes extends JFormField
{
	public $type = 'Profiletypes';
		
	function getInput(){

		// get array of all visible profile types (std-class)
		$pTypeArray = XiptLibProfiletypes::getProfiletypeArray(array('published'=>1, 'visible'=>1));
		// add none option in profile-type array
		//array_unshift($pTypeArray,$none);
		return JHTML::_('select.genericlist',  $pTypeArray, $this->name, null, 'id', 'name', $this->value);
	}
}
