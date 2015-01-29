<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   WildbrettFarben
 * @author    Ronny Peinelt
 * @license   GNU/LGPL
 * @copyright Ronny Peinelt 2015
 */


/**
 * Table tl_wildbrettfarben
 */
$GLOBALS['TL_DCA']['tl_wildbrettfarben'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 0,
			'fields'                  => array('sorting'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('sorting','title','rgb'),
			'showColumns'			  => false,
			'label_callback'          => array('tl_wildbrettfarben', 'formatBEListLabel'),
			'format'                  => '%s,%s,%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{title_legend},title;rgb;sorting'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'rgb' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['rgb'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('size' => 3, 'multiple' => true, 'mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'sorting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettfarben']['sorting'],
			'inputType'               => 'text',
			'default'                => false,  
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
		
	)
);


class tl_wildbrettfarben extends Backend
{
	public function formatBEListLabel($row, $label, DataContainer $dc, $args)
	{
		#var_dump($args[0]);
		#die();
		$tmp[0] = '<span style="font-size:;font-weight:normal;color:#777;">' . $args[0] . '</span>';
		$tmp[1] = '<span style=font-size:;font-weight:bold;color:#555;">' .  $args[1] . '</span>';
		$tmp[2] = '<span style="display:inline-block;width:14px;height:14px;margin-right:5px;margin-left:5px;top:5px;background-color:rgb(' . $args[2] . ');font-weight:bold;color:#777;"></span>';
		
		$args[0] = $tmp[0];
		$args[1] = $tmp[2];
		$args[2] = $tmp[1];
		
		return $args;
	}

}