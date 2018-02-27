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

		// Only trigger on successful user creation
		if (!$success)
		{
			$process = false;
		}

		// Only trigger on new user creation, not subsequent edits
		// if (!$isnew)
		// {
		// 	$process = false;
		// }

		// Only trigger on front-end user creation.
		if (!$this->container->platform->isFrontend())
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

		// if ((strpos($ip, '::') === 0) && (strstr($ip, '.') !== false))
		// {
		// 	$ip = substr($ip, strrpos($ip, ':') + 1);
		// }

		// Get the user agent string
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		// Get current date and time in database format
		JLoader::import('joomla.utilities.date');
		$now = new Date();
		$now = $now->toSql();

		// Load the component's administrator translation files
		// $jlang = JFactory::getLanguage();
		// $jlang->load('com_admintools', JPATH_ADMINISTRATOR, 'en-GB', true);
		// $jlang->load('com_admintools', JPATH_ADMINISTRATOR, $jlang->getDefault(), true);
		// $jlang->load('com_admintools', JPATH_ADMINISTRATOR, null, true);

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
			$this->db->insertObject('#__user_notes', $userNote, 'id');
		}
		catch (Exception $e)
		{
			// Do nothing if the save fails
		}
	}

}

