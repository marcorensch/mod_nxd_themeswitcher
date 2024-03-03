<?php

namespace NXD\Module\ThemeSwitcher\Administrator\Helper;

use Joomla\CMS\Factory;

class ModNxdThemeswitcherHelper
{
	public static function handleChangeAjax(){
		$jinput = Factory::getApplication()->input;
		$datastr = $jinput->get('data', '{}', 'RAW');

		error_log('handleChangeAjax called in ThemeSwitcher');
	}
}