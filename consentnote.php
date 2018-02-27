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


// 	 public function onUserAfterLogin($options)
// 	{
// 			// Run in frontend only
// 			if ($this->app->isClient('administrator'))
// 			{
// 				return;
// 			}

// 			$userId = JFactory::getUser()->id;
// 			$db = JFactory::getDbo();
			
// 			$query = $db->getQuery(true)
// 				->select('1')
// 				->from($db->qn('#__user_profiles'))
// 				->where($db->qn('user_id') . ' = ' . (int) $userId)
// 				->where($db->qn('profile_key') . ' = ' . $db->q('profile.consent'));
// 			$db->setQuery($query);

// 			$consent = $db->loadObjectList();

// 			if (!count($consent) === 0)
// 			{
// 				return;
// 			}

// 			// if the count of $consent is 0 then redirecct to com_users profile edit
// 			$this->app->enqueueMessage(\JText::_('PLG_USER_REDIRECTCONSENT_PLEASE_CHECK_THE_BOX'), 'notice');
// 			$this->app->redirect(\JRoute::_('index.php?option=com_users&view=profile&layout=edit', false));
// 	  }
// }
