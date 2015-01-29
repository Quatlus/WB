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
namespace WildbrettShop;


/**
 * Class ModulWildbrettShop
 *
 * @copyright  Ronny Peinelt 2015
 * @author     Ronny Peinelt
 * @package    Devtools
 */
class ModulWildbrettShop extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_wildbrett';

	
	
	protected function compile() {
		// wenn manuelle detailseite
		$moduleParams = $this->Database->prepare("SELECT * FROM tl_module WHERE id=?") 
		                        ->limit(1) 
		                        ->execute($this->id);
		if ($moduleParams->wildbrettshop_modus == 1) {
			$this->strTemplate = 'mod_wildbrett_start';
			$this->Template = new \FrontendTemplate($this->strTemplate);  
			$this->compile_start();
		} else {
			$this->compile_shop();
		}
		
		
	}
	
	/**
	 * Generate the module
	 */
	protected function compile_start()
	{	
		$pid = 1; //shop archiv,  1 = keine unkate
		$objRecord = $this->Database->prepare("SELECT * from tl_wildbrettshop WHERE pid=? ORDER BY sorting ASC")
									->limit(0)
									->execute($pid);
									
		$objColorSorting = $this->Database->prepare("SELECT id,title,rgb from tl_wildbrettfarben ORDER BY sorting")->execute();
		
		$colorsArray = array();
		while ($objColorSorting->next()) {
			$colorsArray[$objColorSorting->id] = array(
				'title' => $objColorSorting->title,
				'rgb' => $objColorSorting->rgb,
				'id' => $objColorSorting->id,
			);
		}
		$objColorSorting->reset();
		
		$colorSorting = array();
		
		
		while ($objColorSorting->next()) {
			$colorSorting[] = $objColorSorting->id;
		}
		
		#var_dump($colorsArray[9]);
						
		$records = array();						
		while ($objRecord->next()) {
		
			$farben = array();
			$echtfarben = array();
			
			if ($objRecord->farben) {
				$colors = unserialize($objRecord->farben);
				$eggholes = unserialize($objRecord->egghole);
				$delivery = unserialize($objRecord->deliverytime);
				foreach ($colors as $value) {
					$objOneColorTitle = $colorsArray[intval($value)];
					
					$rgb = unserialize($objOneColorTitle['rgb']);
					
					$deli = '';
					if($delivery) {
						$deli = (in_array($value, $delivery) ? 'true' : 'false');
					}
					
					$farben[$objOneColorTitle['id']] = array(  'rgb'=>$rgb, 'id'=>$objOneColorTitle['id'], 'title'=>$objOneColorTitle['title'], 'delivery'=> $deli    );
					
					#var_dump($value, $eggholes);
				}
				#var_dump($value, $eggholes);
				
				
				
				
				foreach ($colorSorting as $value) {
					if (array_key_exists($value, $farben) ) {
						$echtfarben[$value] = $farben[$value];
					}
					
				}
				
				$objColorSorting->reset();
			}
			
			if ($objRecord->egghole) {
			#var_dump('#');
				#var_dump($objRecord->title);
				#$colors = unserialize($objRecord->farben);
				$eggholes = unserialize($objRecord->egghole);
				#var_dump($eggholes);
				#var_dump($colorsArray);
				$delivery = unserialize($objRecord->deliverytime);
				foreach ($eggholes as $value) {
					$objOneColorTitle = $colorsArray[intval($value)];
					#var_dump($objOneColorTitle);
					$rgb = unserialize($objOneColorTitle['rgb']);
					#var_dump($rgb);
					$deli = '';
					if($delivery) {
						$deli = (in_array($value, $delivery) ? 'true' : 'false');
					}
					$eggi = '';
					if($eggholes) {
						$eggi = (in_array($value, $eggholes) ? 'true' : 'false');
					}
					
					$farben[$objOneColorTitle['id']] = array(  'rgb'=>$rgb, 'id'=>$objOneColorTitle['id'], 'title'=>$objOneColorTitle['title'], 'delivery'=> $deli ,'egghole'=> $eggi    );
					
					
				}
				#var_dump($value, $eggholes);
				#var_dump($farben);
				
				
				
				foreach ($colorSorting as $value) {
					if (array_key_exists($value, $farben) ) {
						$echtfarben[$value] = $farben[$value];
					}
					
				}
				#var_dump($echtfarben);
				$objColorSorting->reset();
			}
			
			$oneRecord = array (
				'title' => $objRecord->title,
				'text' => $objRecord->text,
				'alias' => $objRecord->alias,
				'image' => $objRecord->image,
				'farben' => $echtfarben,
				'pid' => $objRecord->pid,
				'id' => $objRecord->id,
			);	
			$records[] = $oneRecord;
		}
			
		$this->Template->records = $records;
	}
	
	
	
	
	/**
	 * Generate the module
	 */
	protected function compile_shop()
	{	
		\Input::getInstance()->get('product');
		\Input::getInstance()->get('color');
		$pid = 1; //shop archiv,  1 = keine unkate
		$objRecord = $this->Database->prepare("SELECT * from tl_wildbrettshop WHERE pid=? ORDER BY sorting ASC")
									->limit(0)
									->execute($pid);
		$records = array();						
		while ($objRecord->next()) {
			
			$farben = array();
			$echtfarben = array();
			$farbenegg = array();
			$echtfarbenegg = array();
			if ($objRecord->farben) {
				$colors = unserialize($objRecord->farben);
				$eggholes = unserialize($objRecord->egghole);
				$delivery = unserialize($objRecord->deliverytime);
				foreach ($colors as $value) {
					$objOneColorTitle = $this->Database->prepare("SELECT id,title,rgb from tl_wildbrettfarben WHERE id=? ORDER BY sorting")
										->execute($value);
					$rgb = unserialize($objOneColorTitle->rgb);
					
					$eggi = '';
					if($eggholes) {
						$eggi = (in_array($value, $eggholes) ? 'true' : 'false');
					}
					$deli = '';
					if($delivery) {
						$deli = (in_array($value, $delivery) ? 'true' : 'false');
					}
					$farben[$objOneColorTitle->id] = array(  'rgb'=>$rgb, 'id'=>$objOneColorTitle->id, 'title'=>$objOneColorTitle->title, 'delivery'=> $deli    );
					
					#var_dump($value, $eggholes);
				}
				
				$colorSorting = array();
				$objColorSorting = $this->Database->prepare("SELECT id,title,rgb from tl_wildbrettfarben ORDER BY sorting")->execute();
				
				while ($objColorSorting->next()) {
					$colorSorting[] = $objColorSorting->id;
				}
				
				foreach ($colorSorting as $value) {
					if (array_key_exists($value, $farben) ) {
						$echtfarben[$value] = $farben[$value];
					}
					
				}
			}
			
			if ($objRecord->egghole) {
				$eggholes = unserialize($objRecord->egghole);
				$delivery = unserialize($objRecord->deliverytime);
				#var_dump($eggholes);
				foreach ($eggholes as $value) {
					$objOneColorTitle = $this->Database->prepare("SELECT id,title,rgb from tl_wildbrettfarben WHERE id=? ORDER BY sorting")
										->execute($value);
					$rgb = unserialize($objOneColorTitle->rgb);
					
					$eggi = '';
					if($eggholes) {
						$eggi = (in_array($value, $eggholes) ? 'true' : 'false');
					}
					$deli = '';
					if($delivery) {
						$deli = (in_array($value, $delivery) ? 'true' : 'false');
					}
					$farbenegg[$objOneColorTitle->id] = array(  'rgb'=>$rgb, 'id'=>$objOneColorTitle->id, 'title'=>$objOneColorTitle->title, 'egghole'=> $eggi, 'delivery'=> $deli    );
					
					#var_dump($value, $eggholes);
				}
				
				$colorSorting = array();
				$objColorSorting = $this->Database->prepare("SELECT id,title,rgb from tl_wildbrettfarben ORDER BY sorting")->execute();
				
				while ($objColorSorting->next()) {
					$colorSorting[] = $objColorSorting->id;
				}
				
				foreach ($colorSorting as $value) {
					if (array_key_exists($value, $farbenegg) ) {
						$echtfarbenegg[$value] = $farbenegg[$value];
					}
					
				}
			}
		#var_dump($eggholes);
			
			$oneRecord = array (
				'title' => $objRecord->title,
				'text' => $objRecord->text,
				'farben' => $echtfarben,
				'farbenegg' => $echtfarbenegg,
				'pid' => $objRecord->pid,
				'id' => $objRecord->id,
				'product' => \Input::getInstance()->get('product'),
				'color' => \Input::getInstance()->get('color'),
			);	
			$records[] = $oneRecord;
		}
			
		$this->Template->records = $records;
	}
}
