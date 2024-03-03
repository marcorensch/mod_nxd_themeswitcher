<?php
/**
 * @package                                     NXD Football Manager 2 People Module (mod_nxdfm2_people)
 *
 * @author                                      NXD | Marco Rensch <support@nx-designs.ch>
 * @copyright                                   Copyright(R) 2024 by NXD nx-designs
 * @license                                     GNU General Public License version 2 or later; see LICENSE.txt
 * @link                                        https://www.nx-designs.ch
 *
 */

namespace NXD\Module\ThemeSwitcher\Administrator\Field;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\HiddenField;
use Joomla\CMS\Form\Field\TextField;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;

class OnboardingField extends TextField
{
	protected $type = 'onboarding';

	protected function getInput(): string
	{
		$this->addStylesheet();
		// Render a Button instead of a Textfield
		$html = '<button type="button" class="btn btn-success" id="onboarding-button">' . Text::_("MOD_NXD_THEMESWITCHER_START_ONBOARDING_BTN_LABEL"). '</button>';
		return $html;
	}

	private function addStylesheet()
	{
		$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
		$wa->useScript('jquery');
		$wa->registerAndUseScript('OnboardingJs', 'administrator/modules/mod_nxd_themeswitcher/src/Field/assets/OnboardingField/js/onboarding.js', ['jquery'], ['type' => 'module', 'version' => 'auto']);
		$wa->registerAndUseStyle('OnboardingCss', 'administrator/modules/mod_nxd_themeswitcher/src/Field/assets/OnboardingField/css/onboarding.css');
	}
}