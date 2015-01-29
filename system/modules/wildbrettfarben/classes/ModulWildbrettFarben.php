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
 * Namespace
 */
namespace WildbrettFarben;


/**
 * Class ModulWildbrettFarben
 *
 * @copyright  Ronny Peinelt 2015
 * @author     Ronny Peinelt
 * @package    Devtools
 */
class ModulWildbrettFarben extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_wildbrettfarben';

	
	
	protected function compile() {
		$objRecord = $this->Database->prepare("SELECT * from tl_wildbrettfarben ORDER BY sorting ASC")
									->limit(0)
									->execute();
		$colorArray = array();
		while ($objRecord->next()) {
			$colorArray[] = array(
				'title' => $objRecord->title,
				'rgb' => $objRecord->rgb,
				'id' => $objRecord->id,
			);
		}
							
		$this->Template->farben =$colorArray;
		
	}
	
}
