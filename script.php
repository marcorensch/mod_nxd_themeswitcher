<?php

/**
 * Script file of ThemeSwitcher Module.
 *
 * The name of this class is dependent on the extension being installed.
 * The class name should have the extension's name, directly followed by
 * the text InstallerScript (ex:. mod_nxd_themeswitcherInstallerScript).
 *
 * This class will be called by Joomla!'s installer, if specified in your component's
 * manifest file, and is used for custom automation actions in its installation process.
 *
 * In order to use this automation script, you should reference it in your component's
 * manifest file as follows:
 * <scriptfile>script.php</scriptfile>
 *
 * @package     Joomla.Administrator
 * @subpackage  mod_nxd_themeswitcher
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;


class mod_nxd_themeswitcherInstallerScript
{
	public function install($parent)
	{
		Factory::getApplication()->enqueueMessage('The module has been installed successfully.');

		// then open print the message to the user
		$url = 'index.php?option=com_modules&view=modules&client_id=1&filter_search=NXD%20ThemeSwitcher';
		Factory::getApplication()->enqueueMessage(Text::sprintf("MOD_NXD_THEMESWITCHER_ONBOARDING_MESSAGE", $url));
	}

	public function uninstall($parent)
	{
		Factory::getApplication()->enqueueMessage('The module has been uninstalled successfully.');
	}

	public function update($parent)
	{
		Factory::getApplication()->enqueueMessage('The module has been updated successfully.');
	}
}