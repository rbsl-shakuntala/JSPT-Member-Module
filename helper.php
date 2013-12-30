<?php
/**
 * @category	Latest Member Helper
 * @package		JomSocial
 * @subpackage	Groups 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license Copyrighted Commercial Software
 */

defined('_JEXEC') or die('Restricted access');

if( !function_exists('XiptLatestMember') )
{
	function XiptLatestMember($limit = 15, $updated_avatar_only, $profile_type)
	{
		$db	 			= JFactory::getDBO();
		if(is_array($profile_type)) {
			$profile_type 	= implode(',', $profile_type);
		}
		
		if($updated_avatar_only)
		{
			$condition = 'AND b.' . $db->quoteName( 'avatar' ) . ' != ' . $db->Quote( 'components/com_community/assets/default.jpg' ) . ' ';
		}
		else
		{
			$condition = ' ';
		}
		
		$query	= 'SELECT * FROM ' . $db->quoteName( '#__users' ) . ' AS a ' 
				. 'LEFT JOIN ' . $db->quoteName( '#__xipt_users' ) . ' AS b ON a.' . $db->quoteName( 'id' ) . ' = b.' . $db->quoteName( 'userid' ) . ' '
				. 'WHERE b.' . $db->quoteName( 'profiletype' ) . ' IN(' . $profile_type . ')'
				. 'AND a.' . $db->quoteName( 'block' ) . ' = ' . $db->Quote(0)
				. $condition
				. 'ORDER BY a.' . $db->quoteName( 'registerDate' ) . ' '
				. 'DESC LIMIT ' . $limit;
		$db->setQuery( $query );
		
		$result = $db->loadObjectList();
	
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
		
		return $result;
	}
}
