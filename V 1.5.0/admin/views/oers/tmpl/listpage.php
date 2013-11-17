<?php
/**
 * @version		1.5.0 OER $
 * @package		oer
 * @copyright	Copyright © 2013 - All rights reserved.
 * @license		GNU/GPL
 * @author		Dr Kaushal Keraminiyage
 * @author mail	admin@confmgt.com
 * @website		www.confmgt.com
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// load tooltip behavior
JHtml::_('behavior.tooltip');
?>

<h1> <?php echo JText::_('LIST_HEADING'); ?> </h1>
<p> <?php echo JText::_('OER_LIST_DESCRIPTON'); ?> </p>

<form action="<?php echo JRoute::_('index.php?option=com_oer'); ?>" method="post" name="adminForm">
<table width="100%" class="adminlist">
<tr>
	<td colspan="4">
		<?php echo JText::_( 'OER_SEARCH' ); ?>:
		<input type="text" size="50" maxlength="250" name="search" id="search" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="inputbox" onchange="document.adminForm.submit();" />
		<button class="button" onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button class="button" onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td>
</tr>
</table>

<table width="100%" class="adminlist">
 <thead>
    <th width="10"><?php echo JText::_('OER_ID'); ?> </td>
    <th width="20">
    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->data ); ?>);" />
    </th>
    <th width="15%%"><?php echo JText::_('OER_TITLE'); ?></td>
    <th width="15%"><?php echo JText::_('OER_SUBMITTED_BY'); ?></td>
    <th width="15%"><?php echo JText::_('OER_DATE'); ?></td>
    <th width="25%"><?php echo JText::_('OER_DESC'); ?></td>
    <th width="15%"><?php echo JText::_('OER_FILE'); ?></td>
    <th width="10%"><?php echo JText::_('OER_PUBLISH'); ?></td>
  </thead>
			<?php 
			$class='row0';	
			$oers=$this->data;
			$numofoers=count($oers);
			if ($numofoers==0){
			?>
			<tr>
            <td colspan="4" ><?php echo JText::_('NO_OERS_SUBMITTED'); ?> </td>	
            </tr>
            <?php 
			}else{
				for ($i=0, $n=count( $oers ); $i < $n; $i++)
				{
					$row =& $oers[$i];
        			$checked    = JHTML::_( 'grid.id', $i, $row->id );
					$submitted_by =  JFactory::getUser($row->userid);
					if ($class=='row1'){
					$class='row0';
					}else{
					$class='row1';
					}
					?>
 					<tr class="<?php echo $class;?>">
      				<td><?php if ($row->id > 0) {
						echo $row->id; 
                        }else{
                        echo JText::_('INVALID_RESOURCE');
						}
						?>
                        
                    </td>
                    <td><?php echo $checked; ?></td>
   	  				<td><?php echo $row->title; ?></td>
   					<td><?php echo $submitted_by->name; ?></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->description; ?></td>
                    <td><?php echo '<a href="index.php?option=com_oer&controller=oer&task=download&fname='.$row->filedata.'">'.$row->filedata.'</a>'; ?></td>
                    <td><?php echo JHTML::_('grid.published', $row, $i, $imgY= 'tick.png', $imgX= 'publish_x.png', $prefix=''); ?></td>
   					</tr>
				<?php 
				}
			}
				?>
                <tfoot>
                <td colspan="8"> <?php echo $this->pagination->getListFooter(); ?> </td>
                </tfoot>
	
				</table>
                <input type="hidden" name="option" value="com_oer" />
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="controller" value="oer" />
 


</form>

