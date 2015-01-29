<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   WildbrettShop
 * @author    Ronny Peinelt
 * @license   GNU/LGPL
 * @copyright Ronny Peinelt 2015
 */


/**
 * Table tl_wildbrettshop
 */
$GLOBALS['TL_DCA']['tl_wildbrettshop'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_wildbrettshop_archiv',
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
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'child_record_callback'   => array('tl_wildbrettshop', 'listShops'),
			'headerFields'            => array('title', 'tstamp')
			
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
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['show'],
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
		'default'                     => '{title_legend},title,alias,price;{attributes_legend},farben,egghole;deliverytime,deliverytime2;filter;{desc_legend},text;image,requiredPictures'
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
		'pid' => array
		(
			'foreignKey'              => 'tl_faq_category.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'sorting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'                 => true,
			'flag'                    => 11,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('tl_wildbrettshop', 'generateAlias')
			),
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"

		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['text'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'helpwizard'=>false, 'tl_class'=>' w50 '),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		'filter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['filter'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_wildbrettshop','listFilter'),
			'eval'                    => array('mandatory'=>false, 'multiple'=>true, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'farben' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['farben'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_wildbrettshop','listFarben'), 
			'eval'                    => array('submitOnChange'=>true, 'mandatory'=>false, 'multiple'=>true, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'egghole' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['egghole'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'default'				  => 1,
			#'options'				  => array(1 => 'verlängerte Lieferzeit'),
			'options_callback'		  => array('tl_wildbrettshop','listFarben'), 
			'eval'                    => array('submitOnChange'=>true, 'multiple'=>true,'tl_class'=>'w50  ', 'mandatory'=>false ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'deliverytime' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['deliverytime'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'default'				  => 1,
			#'options'				  => array(1 => 'verlängerte Lieferzeit'),
			'options_callback'		  => array('tl_wildbrettshop','listFarbenDyn'), 
			'eval'                    => array('submitOnChange'=>true, 'multiple'=>true,'tl_class'=>'w50 clr', 'mandatory'=>false ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		)
		,
		'deliverytime2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['deliverytime2'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'default'				  => 1,
			#'options'				  => array(1 => 'verlängerte Lieferzeit'),
			'options_callback'		  => array('tl_wildbrettshop','listFarbenDyn2'), 
			'eval'                    => array('submitOnChange'=>true, 'multiple'=>true,'tl_class'=>'w50 ', 'mandatory'=>false ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'price' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['price'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'digit'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'image' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['image'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('submitOnChange'=>true, 'files'=>false, 'fieldType'=>'radio', 'mandatory'=>false, 'tl_class'=>'clr w50'),
			'sql'                     => "binary(16) NULL"
		),
		'requiredPictures' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_wildbrettshop']['requiredPictures'],
			'default'                 => 'text',
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'options_callback'        => array('tl_wildbrettshop', 'showRequiredPictures'),
			#'reference'               => &$GLOBALS['TL_LANG']['CTE'],
			'eval'                    => array('readonly'=>true, 'chosen'=>false,'multiple'=>true, 'submitOnChange'=>false),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		
	)
);


class tl_wildbrettshop extends Backend
{
	
	/**
	 * Return all content elements as array
	 * @return array
	 */
	public function showRequiredPictures($var)
	{
		
		$objImagePath = $this->Database->prepare("SELECT image,title,alias FROM tl_wildbrettshop WHERE ID=?")->execute($var->activeRecord->id);
		
		$imagePath = $objImagePath->image;
		$objFile = \FilesModel::findByPk($imagePath);
		$imagePath = $objFile->path;

		$firstFolder = strpos($imagePath, '/');
		$imagePath = substr($imagePath, $firstFolder+1);
		//---
		$aliasPath = $objImagePath->alias;
		
		
		$values = array();
		$objVariantenOhne = $this->Database->prepare("SELECT farben FROM tl_wildbrettshop WHERE ID=?")->execute($var->activeRecord->id);
		if ($objVariantenOhne->numRows < 1) {
			return $values;
		}
		$objFarbenArray = array();
		
		$objVariantenMit = $this->Database->prepare("SELECT egghole FROM tl_wildbrettshop WHERE ID=?")->execute($var->activeRecord->id);
		if ($objVariantenMit->numRows < 1) {
			return $values;
		}

		
		$objFarben = $this->Database->prepare("SELECT * FROM tl_wildbrettfarben ORDER BY title ASC")->execute();
		if ($objFarben->numRows < 1) {
			return $values;
		}
		while($objFarben->next()) {
			$objFarbenArray[$objFarben->id] = $objFarben->title;
		}
		
		#var_dump($objFarbenArray);
		$first =  unserialize($objVariantenOhne->farben);
		$second = unserialize($objVariantenMit->egghole);
		
		if($first && $second) {
			$merged = array_merge($first,$second);
			$consolidated = array();
			foreach ($merged as $key => $value) {
				if(!in_array($value,$consolidated)) $consolidated[] = $value;
			} 
		}
		else if ($first && !$second) {
			$consolidated = $first;
		}
		else if (!$first && $second) {
			$consolidated = $second;
		}
		#var_dump($consolidated);
		
		
		#die();
		foreach ( $consolidated as $key => $value) {
			$fp = '../files/' . $imagePath . '/' . $aliasPath . '_' . standardize($objFarbenArray[$value]) . '.png';
			$values[$value] = $imagePath . '/' . $aliasPath . '_' . standardize($objFarbenArray[$value]) . '.png ' . ( file_exists($fp) ? ':<br><img src="' . $fp . '" height="50">' : ' [fehlt]') . '';
		}
		
		
		if($imagePath && $aliasPath) {
			return $values;
		}
		else if(!$imagePath && $aliasPath){
			return array(0=>'Bitte erst links den Bildordner angeben und einmal speichern.');
		} 
		else if($imagePath && !$aliasPath){
			return array(0=>'Bitte erst oben Alias angeben. (einfach einmal speichern)');
		} 
		else if(!$imagePath && !$aliasPath){
			return array(0=>'Bitte erst links den Bildordner angeben und einmal speichern.');
		}
	}
		
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listShops($arrRow)
	{
		return $arrRow['title'];
	}
	
	public function listFilter($var) {
		$values = array();
		$objTags = $this->Database->prepare("SELECT * FROM tl_wildbrettfilter ORDER BY sorting ASC")->execute();
		if ($objTags->numRows < 1) {
			return $values;
		}
		while($objTags->next()) {
			$values[$objTags->id] = $objTags->title;
		}
		return $values;
	}
	
	public function listFarben($var) {
		$values = array();
		$objTags = $this->Database->prepare("SELECT * FROM tl_wildbrettfarben ORDER BY sorting ASC")->execute();
		if ($objTags->numRows < 1) {
			return $values;
		}
		while($objTags->next()) {
			$values[$objTags->id] = $objTags->title;
		}
		return $values;
	}
	
	public function listFarbenDyn($var) {
		#var_dump($var->activeRecord->id);
		$values = array();
		$objTags = $this->Database->prepare("SELECT farben FROM tl_wildbrettshop WHERE ID=?")->execute($var->activeRecord->id);
		if ($objTags->numRows < 1) {
			return $values;
		}
		
		$objFarbenArray = array();
		$objFarben = $this->Database->prepare("SELECT * FROM tl_wildbrettfarben ORDER BY sorting ASC")->execute();
		if ($objFarben->numRows < 1) {
			return $values;
		}
		
		while($objFarben->next()) {
			$objFarbenArray[$objFarben->id] = $objFarben->title;
		}
		#var_dump($objFarbenArray);
		while($objTags->next()) {
			foreach ( unserialize($objTags->farben) as $key => $value) {
				$values[$value] = $objFarbenArray[$value];
			}
			#var_dump( unserialize($objTags->farben));
		}
		return $values;
	}
	
	public function listFarbenDyn2($var) {
		#var_dump($var->activeRecord->id);
		$values = array();
		$objTags = $this->Database->prepare("SELECT egghole FROM tl_wildbrettshop WHERE ID=?")->execute($var->activeRecord->id);
		if ($objTags->numRows < 1) {
			return $values;
		}
		#var_dump($objTags);
		$objFarbenArray = array();
		$objFarben = $this->Database->prepare("SELECT * FROM tl_wildbrettfarben ORDER BY sorting ASC")->execute();
		if ($objFarben->numRows < 1) {
			return $values;
		}
		while($objFarben->next()) {
			$objFarbenArray[$objFarben->id] = $objFarben->title;
		}
		#var_dump($objFarbenArray);
		while($objTags->next()) {	
		#	var_dump($objTags);
			foreach ( unserialize($objTags->egghole) as $key => $value) {
				$values[$value] = $objFarbenArray[$value];
			}
			#var_dump( unserialize($objTags->farben));
		}
		return $values;
	}
	/**
		 * Auto-generate an article alias if it has not been set yet
		 * @param mixed
		 * @param \DataContainer
		 * @return string
		 * @throws \Exception
		 */
		public function generateAlias($varValue, DataContainer $dc)
		{
			$autoAlias = false;
	
			if ($varValue == '')
			{
				
				$varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title));
			}
	
			return $varValue;
		}
		
}
