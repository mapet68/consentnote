<?php
/**
 * @package    consentnote
 * @author     Brian Teeman
 * @copyright  (C) 2018 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @since  1.0
 */
class PlgUserConsentNoteInstallerScript extends JInstallerScript
{
	/**
	 * Extension script constructor.
	 *
	 * @since   1.0
	 */
	public function __construct()
	{
		// Define the minumum versions to be supported.
		$this->minimumJoomla = '3.8';
		$this->minimumPhp    = '7.0';
	}
}