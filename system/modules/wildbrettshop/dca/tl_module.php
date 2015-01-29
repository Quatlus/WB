<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package FlexSlider
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['wildbrettshop'] = '{title_legend},name,type,headline,wildbrettshop_modus';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['wildbrettshop_modus'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['wildbrettshop_modus'],
    'exclude'                 => true,
    'inputType'               => 'radio',
    'options'				  => array(1=>'Start [alle Varianten]',2=>'Shop [Kompaktansicht]'),	
    'eval'					  => array('tl_class'=>'long m12 clr'),
    'sql'					  => "char(1) NOT NULL default ''"
);
