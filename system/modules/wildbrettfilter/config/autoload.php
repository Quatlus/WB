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
	'WildbrettFilter',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'WildbrettFilter\ModulWildbrettFilter' => 'system/modules/wildbrettfilter/classes/ModulWildbrettFilter.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_wildbrettfilter' => 'system/modules/wildbrettfilter/templates'
));
