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
namespace WildbrettFilter;


/**
 * Class ModulWildbrettFilter
 *
 * @copyright  Ronny Peinelt 2015
 * @author     Ronny Peinelt
 * @package    Devtools
 */
class ModulWildbrettFilter extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_wildbrettfilter';

	
	
	protected function compile() {
		$objRecord = $this->Database->prepare("SELECT * from tl_wildbrettfilter ORDER BY sorting ASC")
									->limit(0)
									->execute();
		$filterArray = array();
		while ($objRecord->next()) {
			$filterArray[] = array(
				'title' => $objRecord->title,
				#'rgb' => $objRecord->rgb,
				'id' => $objRecord->id,
			);
		}
							
		$this->Template->filter =$filterArray;
		
	}
	
}
