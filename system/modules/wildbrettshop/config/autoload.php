<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Wildbrettshop
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'WildbrettShop',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'WildbrettShop\ModulWildbrettShop' => 'system/modules/wildbrettshop/classes/ModulWildbrettShop.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_wildbrett' => 'system/modules/wildbrettshop/templates',
	'mod_wildbrett_start' => 'system/modules/wildbrettshop/templates',
));
