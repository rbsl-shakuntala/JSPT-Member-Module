<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once JPATH_ROOT.DS.'components'.DS.'com_xipt'.DS.'api.xipt.php';

class JElementProfiletypes extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Profiletypes';

	function fetchElement($name, $value, &$node, $control_name)
	{
		//$params = JComponentHelper::getParams('com_xipt');
		$ptypeHtml = $this->getProfiletypeFieldHTML($name,$value);

		return $ptypeHtml;
	}
	

function getProfiletypeFieldHTML($name,$value)
	{	
		$required			='1';
		$html				= '';
		$class				= ($required == 1) ? ' required' : '';
		$options			= XiptAPI::getProfiletypeIds();
		if($options){
		$html	.= '<select id="params['.$name.']" name="params['.$name.']" class="hasTip select'.$class.'" title="' . "Select Account Type" . '::' . "Please Select your account type" . '">';
		foreach($options as $option)
		{
		    $name		= $option->name;
			$id			= $option->id;
		    
		    $selected	= ( JString::trim($id) == $value ) ? ' selected="true"' : '';
			$html	.= '<option value="' . $id . '"' . $selected . '>' . $name . '</option>';
		}
		$html	.= '</select>';	
		$html   .= '<span id="errprofiletypemsg" style="display: none;">&nbsp;</span>';
		}
		else
		$html=JText::_('PROFILE TYPE NOT CREATED');
		return $html;
	}

}
