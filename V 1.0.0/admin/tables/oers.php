<?php 
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* ConfMgt abstracts Table class
*
* @package		Joomla
* @subpackage	OER
* @since 1.5
*/
class Tableoers extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $userid = null;

	/**
	 * @var Varchar
	 */
	var $title = null;

	/**
	 * @var bool
	 */
	var $description = null;

	/**
	 * @var sText
	 */
	var $oertype = null;

	/**
	 * @var Varchar
	 */
	var $keywords = null;

	/**
	 * @var Varchar
	 */
	var $date = null;
	
	/**
	 * @var Varchar
	 */	
	var $filedata=null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__oer_oers', 'id', $db);
	}
}