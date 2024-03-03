<?php
/**
 * @package                                     NXD ThemeSwitcher
 *
 * @author                                      NXD | Marco Rensch <support@nx-designs.ch>
 * @copyright                                   Copyright(R) 2024 by NXD nx-designs
 * @license                                     GNU General Public License version 2 or later; see LICENSE.txt
 * @link                                        https://www.nx-designs.ch
 *
 * @var $settings Joomla\CMS\Parameter\Parameter  The module parameters
 * @var $player stdClass                        The player object
 *
 */


namespace NXD\Module\ThemeSwitcher\Administrator\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\Registry\Registry;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

	public function dispatch()
	{
		// The guided tour will not show if no user is logged in.
		$user = $this->getApplication()->getIdentity();
		if ($user === null || $user->id === 0)
		{
			return;
		}

		parent::dispatch();
	}

    protected function getLayoutData()
    {
        $data = parent::getLayoutData();
//        $data['game'] = $this->getHelperFactory()->getHelper('NextGameHelper')->getNextGame($data['params'], $this->getApplication());

        return $data;
    }
}