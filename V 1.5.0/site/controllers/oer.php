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

jimport('joomla.application.component.controller');
 require_once (JPATH_COMPONENT_SITE.DS.'helpers'.DS.'oer.php');

class oerControllerOer extends oerController
{
function __construct()

	{
		parent::__construct();  
	}
	
function display()

	{
			$user =& JFactory::getUser(); 
		
			if ($user->guest) { // if user not logged in 
				$redirectUrl = 'index.php?option=com_oer';
				$redirectUrl = urlencode(base64_encode($redirectUrl));
				$this->setredirect(JRoute::_('index.php?option=com_user&view=login&return='.$redirectUrl),JText::_('NEEDS_LOGIN')); 
			}else if ( ! JRequest::getCmd( 'layout' ) ) {
			JRequest::setVar('view', 'oers' );
			JRequest::setVar('layout', 'listpage' );
			}
			
        parent::display();
    }
	
function loginrequired() // check if the user need to be logged in to complete an action  
	{
		$user =& JFactory::getUser();
		if ( $user->guest) { // if not logged in
		return true;
		}else{
		return false;
		}
     }

function getlicence() // check if the user need to be logged in to complete an action  
	{
	$model = $this->getModel('oer');
	$out = $model->getDataLicence();
	echo $out->decs.'<br />' .
	'<a href="'.$out->url.'">'.$out->url.'</a>';

	return; 
     }


function listpage()
	{
		JRequest::setVar('controller', 'oer');
		JRequest::setVar('view', 'oers');
		JRequest::setVar('layout', 'listpage');
		parent::display();	
	}
	
function viewpage()
	{
		
		JRequest::setVar('controller', 'oer');
		JRequest::setVar('view', 'oer');
		JRequest::setVar('layout', 'viewpage');
		parent::display();
		
	}

function edit()
	{
	
		if ($user->guest) { // if user not logged in 
			$redirectUrl = 'index.php?option=com_oer';
			$redirectUrl = urlencode(base64_encode($redirectUrl));
			$this->setredirect(JRoute::_('index.php?option=com_user&view=login&return='.$redirectUrl),JText::_('NEEDS_LOGIN')); 
		}else if ( ! JRequest::getCmd( 'layout' ) ) {
			JRequest::setVar('view', 'oer');
			JRequest::setVar('layout', 'form');
		}
			parent::display();
	}
	
function addnew()
	{
		
		$user =& JFactory::getUser(); 
		
			if ($user->guest) { // if user not logged in 
				$redirectUrl = 'index.php?option=com_oer';
				$redirectUrl = urlencode(base64_encode($redirectUrl));
				$this->setredirect(JRoute::_('index.php?option=com_user&view=login&return='.$redirectUrl),JText::_('NEEDS_LOGIN')); 
			}else if ( ! JRequest::getCmd( 'layout' ) ) {
				JRequest::setVar('view', 'oer');
				JRequest::setVar('layout', 'form');
			}
		
        parent::display();
	}
	
	
	
	
function cancel()
	{
		JRequest::setVar('view', 'oers');
		JRequest::setVar('controller', 'oer');
		JRequest::setVar('layout', 'listpage');
		parent::display();
	}
	
function fileUpload()
	
	{    
		jimport('joomla.filesystem.file');		
		$component = JComponentHelper::getComponent('com_oer');
		$user =& JFactory::getUser();
		$params = new JParameter( $component->params );
		$max = ini_get('upload_max_filesize');	    
		$filesAllowed =  $params->def( 'file_types', 'doc,ppt,docx,pdf');
		$file = JRequest::getVar('filedata', null, 'files', 'array'); 
		
		$msg = array();
		unset($msg);
		$msg['return'] = true;
		$msg['filename'] = null;
		$msg['error'] = null;
		       
        if(isset($file)){ 
                			
                $filename = JFile::makeSafe($file['name']);
				$uploadedFileExtension = JFile::getExt($filename);
				$fname = $user->name.'-'.time().'.'.$uploadedFileExtension;
                $filename = JFile::makeSafe($fname);
 
                if($file['size'] > $max*1024*1024) 
				{ 
					$msg ['error'] = JText::_('ONLY_FILES_UNDER').' '.$max;
					$msg ['return'] = false;
				
                }
				
				$validFileExts = explode(',', $filesAllowed);
				//assume the extension is false until we know its ok
				$extOk = false;
				//go through every ok extension, if the ok extension matches the file extension (case insensitive)
				//then the file extension is ok
				foreach($validFileExts as $key => $value)
				{
					$test= "/\b".$value."\b/i";
					
	    				if( preg_match($test, $uploadedFileExtension ) )
        				{
           					$extOk = true;
        				}
				}
				if ($extOk == false) 
				{
        			$msg ['error'] = $msg['error'].'<br />'. JText::_( 'INVALID EXTENSION' ).' '.$uploadedFileExtension;
					$msg ['return'] = false;
	
				}
				
				$fileError = $file['error'];
				if ($fileError > 0) 
				{
        			switch ($fileError) 
       			 	{
        				case 1:
						$msg ['error'] = $msg['error'].'<br />'.JText::_( 'FILE TO LARGE THAN PHP INI ALLOWS' );
						$msg ['return'] = false;
				 
						case 2:
						$msg ['error'] = $msg['error'].'<br />'.JText::_( 'FILE TO LARGE THAN HTML FORM ALLOWS' );
						$msg ['return'] = false;
				 
						case 3:
						$msg ['error'] = $msg['error'].'<br />'.JText::_( 'ERROR PARTIAL UPLOAD' );
						$msg ['return'] = false;
				 
						case 4:
						$msg ['error'] = $msg['error'].'<br />'.JText::_( 'ERROR NO FILE' );
						$msg ['return'] = false;

					}
				}
				
				$src = $file['tmp_name'];
                $dest = JPATH_COMPONENT.DS.'upload'.DS.$filename;
				
				if ($msg['return'] == true) {
 
                
					if ( JFile::upload($src, $dest) ) {
	 
						//Redirect to a page of your choice
						$msg ['error'] = JText::_('FILE_SAVE_AS');
						$msg ['return'] = true;
						$msg ['filename'] = $filename;
					} else {
						//Redirect and throw an error message
						$msg ['error'] = $msg['error'].'<br />'.JText::_('ERROR_IN_UPLOAD');
						$msg ['return'] = false;
					}
				}
         
        }
        return $msg;
	}
	
function save()
	{
		
		$mainframe = JFactory::getApplication();
		$component = JComponentHelper::getComponent('com_oer');
   		$params = new JParameter( $component->params );	
		$user =& JFactory::getUser();
		$upload = $this->fileUpload();
		$post = JRequest::get('post');
		$id = $post['id'];
		if ($upload['return'] == true )
		{
			$post['filedata'] = $upload ['filename'];
			$model = $this->getModel('oer');
			if ($model->store($post,'oer')) 
			{
				$msg .= $upload['error'].'<br />'. JText::_( 'UPLOAD_SAVED');
				//sending email notifications
				
				//fixing the str repalcements
				
				$replace = array(
    			'[SITE]' => $mainframe->getCfg('sitename'),
				'[SITE_BACKEND]' => JURI::base().'/administrator',
    			'[AUTH_NAME]' => $user->name,
    			'[TITLE]' => $post['title'],
				'[ADMIN_NAME]' => 'Administrator',
				'[OER_ID]' => $post['id'],
				);
				
				if ($params->def('send_emails',1))
				{
					//to the admin
					$admin_body = str_replace(array_keys($replace), array_values($replace), JText::_( 'OER_ADMIN_EMAIL_BODY' ));
					$admin_subject = str_replace(array_keys($replace), array_values($replace), JText::_( 'OER_ADMIN_EMAIL_SUBJECT' ));
					$admin_from = $params->def('email_from',$mainframe->getCfg('mailfrom'));
					$admin_to = $params->def('admin_email',$mainframe->getCfg('mailfrom'));
					
					
					
					
					# Invoke JMail Class
					$admin_mailer = JFactory::getMailer();
					# Set sender array
					$admin_mailer->setSender($admin_from);
					# Add a recipient -- this can be a single address (string) or an array of addresses
					$admin_mailer->addRecipient($admin_to);
					$admin_mailer->setSubject($admin_subject);
					$admin_mailer->setBody($admin_body);
					# If you would like to send as HTML, include this line; otherwise, leave it out
					$admin_mailer->isHTML(false);
					# Send once you have set all of your options
					if ($admin_mailer->send()){
						$msg .= JText::_( ' Notification email sent to the Administrator. ' );
					}else{
						$msg .= JText::_( ' Administrator could not be notified. Email failed. ' );
					}
				}
			
				
				//to the author
				
				$auth_body = str_replace(array_keys($replace), array_values($replace), JText::_( 'OER_AUTH_EMAIL_BODY' ));
				$auth_subject = str_replace(array_keys($replace), array_values($replace), JText::_( 'OER_AUTH_EMAIL_SUBJECT' ));
				$auth_from = $params->def('email_from',$mainframe->getCfg('mailfrom'));
				$auth_to = $user->email;
				
				# Invoke JMail Class
				$auth_mailer = JFactory::getMailer();
				# Set sender array
				$auth_mailer->setSender($auth_from);
				# Add a recipient -- this can be a single address (string) or an array of addresses
				$auth_mailer->addRecipient($auth_to);
				$auth_mailer->setSubject($auth_subject);
				$auth_mailer->setBody($auth_body);
				# If you would like to send as HTML, include this line; otherwise, leave it out
				$auth_mailer->isHTML(false);
				# Send once you have set all of your options
				if ($auth_mailer->send()){
					$msg .= JText::_( 'Notification email sent to the author. ' );
				}else{
					$msg .= JText::_( 'Author could not be notified. Email failed. ' );
				}				
				
			} else { //issues with saving to DB
				$msg .= $uplaod['error'].'<br />'.JText::_( 'ERROR_SAVING_UPLOAD_DB' );
				$msg .= ' ['.$model->getError().'] ';
			}
   			$this->setRedirect(JRoute::_('index.php?option=com_oer&controller=oer&view=oers'), $msg, 'information');
		}else{ //issues with file upload
			$mainframe =& JFactory::getApplication();
			$mainframe->setUserState( "oer.post", $post );
			$this->setRedirect(JRoute::_('index.php?option=com_oer&controller=oer&view=oer&layout=form&id='.$id), $upload['error'], 'error');
		}	
	
	}
	
function download() 
	{
		
		jimport('joomla.filesystem.file');	
		$fname = JRequest::getVar('fname', 'oers');
		$fname=JFile::makeSafe($fname);
		$ddl = oerHelper::download($fname);
		if ($ddl = 2) {
			$msg = JText::_( 'No file in the system by that name');
			$this->setRedirect(JRoute::_('index.php?option=com_oer'), $msg, 'error');
		}
	}
	
function emailStrRepalce($string)
	{
		$replacements = array(
    	'[SITE]' => '$site',
    	'[NAME]' => '$name',
    	'[TITLE]' => '$title',
		);
		
	}


}