<?php
/**
 * @package    consentnote
 * @author     Brian Teeman
 * @copyright  (C) 2018 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

/**
 * Class for Consent Note
 *
 * @since  1.0
 */
class PlgUserConsentNote extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  1.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  1.0
	 */
	protected $app;

	/**
	 * Check if a user has already consented when they login.
	 * If not will load the edit profile
	 *
	 * @param   array  $options  Array holding options
	 *
	 * @return  boolean  True on success
	 *
	 * @since   1.0
	 */

	public function onUserAfterSave($user, $isnew, $success, $msg)
	{
		$process = true;

		// Only trigger on front-end user creation.
		if ($this->app->isClient('administrator'))
		{
			$process = false;
		}

		if (!$process)
		{
			return;
		}

		// Create a new user note
		// Get the user's ID
		$user_id = (int)$user['id'];

		// Get the IP address
		$ip=$_SERVER['HTTP_CLIENT_IP'];

		// Get the user agent string
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		// Get the date in DB format
		$now = JFactory::getDate()->toSql();

		// Create and save the user note
		$userNote = (object)array(
			'user_id'         => $user_id,
			'catid'           => 0,
			'subject'         => JText::_('PLG_CONSENTNOTE_SUBJECT'),
			'body'            => JText::sprintf('PLG_CONSENTNOTE_BODY', $ip, $user_agent),
			'state'           => 1,
			'created_user_id' => 42,
			'created_time'    => $now
		);

		try
		{
			$result = JFactory::getDbo()->insertObject('#__user_notes', $userNote, 'id');

		}
		catch (Exception $e)
		{
			// Do nothing if the save fails
		}
	}

}

