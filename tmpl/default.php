<?php

?><div>
	<?php
	if(empty($profile_type))
	{
		echo JText::_('No profiletype selected');
	}
	else if( !empty( $row ) )
	{
	?>
		<div>		
			<ul style="list-style:none; margin: 0 0 10px; padding: 0;">
			<?php		
			foreach( $row as $data )
			{
				$user 		= CFactory::getUser($data->id);				
				$userName 	= $user->getDisplayName();
				$userLink 	= CRoute::_('index.php?option=com_community&view=profile&userid='.$data->id);
				
				$html  = '<li style="display: inline; padding: 0 3px 3px 0; background: none;">';
				$html .= '	<a href="'.$userLink.'">';
				if($tooltips)
				{
					$html .= '	<img width="32" src="'.$user->getThumbAvatar().'" class="avatar hasTipLatestMembers" alt="'.$userName.'" title="'.CTooltip::cAvatarTooltip($user).'" style="padding: 2px; border: solid 1px #ccc;" />';
				}
				else
				{
					$html .= '	<img width="32" src="'.$user->getThumbAvatar().'" alt="'.$userName.'"  style="padding: 2px; border: solid 1px #ccc;" />';
				}
				$html .= '	</a>';
				$html .= '</li>';
				echo $html;
			}
			?>
			</ul>
		</div>
		
		<?php if($showall) { ?>
		<div>
			<?php 
			
			$link = 'index.php?'
						.'operator=or'
						.'&option=com_community&view=search&task=advancesearch' ; 
			$i = 0;
			
			foreach ($profile_type as $profileTypeId) {
				$link .= "&field$i=XIPT_PROFILETYPE"
						."&condition$i=equal"
						."&value$i=$profileTypeId"
						."&fieldType$i=profiletypes"; 
				$keyList[] = $i++;	
			}

			$link .= "&key-list=".urlencode(implode(',', $keyList));
			
			?>
			<a style='float:right;' href='<?php echo CRoute::_($link); ?>'><?php echo JText::_("MOD_XIPTMEMBERS_SHOW_ALL"); ?></a>
			
		</div>
		
	<?php
		}
	}
	else
	{
		echo JText::_('No members yet');
	}
	?>
	<div style='clear:both;'></div>
</div>
