<?php
/**
 * @package                                     NXD ThemeSwitcher
 * @author                                      NXD | Marco Rensch <support@nx-designs.ch>
 * @copyright                                   Copyright(R) 2024 by NXD nx-designs
 * @license                                     GNU General Public License version 2 or later; see LICENSE.txt
 * @link                                        https://www.nx-designs.ch
 *
 * @var $params      Joomla\CMS\Parameter\Parameter  The module parameters
 * @var $game        stdClass                        The NextGame object
 * @var $support     stdClass                        The Array containing support game object(s) or an empty
 * @var $module      stdClass                        The module object
 *
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->useScript('jquery');
$wa->addInlineScript('
    window.jDarkModeDefault = "'.$params->get("darkmode_default", "true").'";
    window.themeSwitcherDbStore = Boolean('.$params->get("db_store", 0).');
');
$wa->registerAndUseScript('nxd-themeswitcher-js', 'administrator/modules/mod_nxdthemeswitcher/tmpl/assets/js/module.js', [], ['defer' => true, 'version' => 'auto'],['core']);
?>

<button type="button" class="header-item-content theme-button" style="border: none;">
  <span class="header-item-icon">
    <span style="margin: 3px; font-size: .8rem; transition: all .6s ease;">🌓</span>
  </span>
	<span class="header-item-text">Dark Mode Switcher</span>
</button>
