<?php
/**
 * @package                                     NXD ThemeSwitcher
 * @subpackage                                  mod_nxd_themeswitcher
 * @version                                     1.0.0
 * @author                                      NXD | Marco Rensch
 * @copyright                                   NXD | nx-designs All rights reserved
 * @license                                     GNU General Public License version 2 or later; see LICENSE.txt
 *
 */

use Joomla\CMS\Factory;
use Joomla\Database\DatabaseInterface;

class ModNxdThemeswitcherHelper
{
	public static function handleChangeAjax()
	{
		// Get the input
		$input = Factory::getApplication()->input;

		// Get the theme
		$useDark = $input->get('data', '', 'string') === 'true';
		$userId = Factory::getApplication()->getIdentity()->id;

		// Store the selection
		$response = ModNxdThemeswitcherHelper::storeSelection($useDark, $userId);

		// Return the response
		echo json_encode(['status' => 'success', 'data' => $response]);
		Factory::getApplication()->close();
	}

	public static function getDarkModeStateAjax()
	{
		// Get the theme
		$userId = Factory::getApplication()->getIdentity()->id;

		// Store the selection
		$response = ModNxdThemeswitcherHelper::getSelection($userId);

		// Return the response
		echo json_encode(['status' => 'success', 'data' => $response]);
		Factory::getApplication()->close();

	}

	private static function getSelection($userId)
	{
		// Get the selection
		$db = Factory::getContainer()->get(DatabaseInterface::class);
		$query = $db->getQuery(true);
		$query->select($db->quoteName('use_dark'))
			->from($db->quoteName('#__nxd_themeswitcher'))
			->where($db->quoteName('user_id') . ' = ' . $db->quote($userId));

		$db->setQuery($query);

		return $db->loadResult();
	}

	private static function storeSelection($useDark, $userId)
	{
		// Store or update the selection
		$useDark = (int) $useDark;
		$db = Factory::getContainer()->get(DatabaseInterface::class);
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id'))
			->from($db->quoteName('#__nxd_themeswitcher'))
			->where($db->quoteName('user_id') . ' = ' . $db->quote($userId));

		$db->setQuery($query);

		$result = $db->loadResult();

		if ($result)
		{
			$query = $db->getQuery(true);
			$query->update($db->quoteName('#__nxd_themeswitcher'))
				->set($db->quoteName('use_dark') . ' = ' . $db->quote($useDark))
				->where($db->quoteName('user_id') . ' = ' . $db->quote($userId));
		}
		else
		{
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('#__nxd_themeswitcher'))
				->columns($db->quoteName('user_id') . ', ' . $db->quoteName('use_dark'))
				->values($db->quote($userId) . ', ' . $db->quote($useDark));
		}

		$db->setQuery($query);
		return $db->execute();

	}
}