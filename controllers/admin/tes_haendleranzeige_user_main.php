<?php

class tes_haendleranzeige_user_main extends tes_haendleranzeige_user_main_parent
{
	
	protected $_blCreditRatingAcive 	= null;	
	protected $_sCreditRatingComparison = null;	
	protected $_dCreditRatingValue 		= null;	
	
	protected $_blGroupsAcive		 	= null;	
	protected $_sGroupLogic		 		= null;
	protected $_sHaendlerGruppe1 		= null;
	protected $_sHaendlerGruppe2 		= null;
	protected $_sHaendlerGruppe3 		= null;
	
	protected $_sBackgroundColor		= null;
	protected $_sColor					= null;
	
	public function __construct()
    {
        
        $config     					= oxRegistry::get('oxConfig');
        
        $this->_blCreditRatingAcive 	= $config->getConfigParam('blCreditRatingAcive');        
        $this->_sCreditRatingComparison = $config->getConfigParam('sCreditRatingComparison');        
        $this->_dCreditRatingValue 		= $config->getConfigParam('dCreditRatingValue');
        
        $this->_blGroupsAcive	 		= $config->getConfigParam('blGroupsAcive');
        $this->_sGroupLogic	 			= $config->getConfigParam('sGroupLogic');
        $this->_sHaendlerGruppe1	 	= $config->getConfigParam('sHaendlerGruppe1');
        $this->_sHaendlerGruppe2	 	= $config->getConfigParam('sHaendlerGruppe2');
        $this->_sHaendlerGruppe3	 	= $config->getConfigParam('sHaendlerGruppe3');
        
        $this->_sBackgroundColor	 	= $config->getConfigParam('sBackgroundColor');
        $this->_sColor	 				= $config->getConfigParam('sColor');
                        
        parent::__construct();
        
    }
	
	public function render ()
	{
		
		$sTpl = parent::render();
		
		$this->_aViewData["oxid"] 	= $this->getEditObjectId();	
		$soxId 						= $this->getEditObjectId();		
		$sViewName					= getViewName("oxgroups", $this->_iEditLang);
	
		$sViewNameObj2G 			= getViewName("oxobject2group", $this->_iEditLang);		
		$oGroupsActive 				= oxNew("oxlist");		
		$oGroupsActive				->init("oxgroups");		
		
		
		$sFilter = "";
		
		if( $this->_blGroupsAcive )
		{
		
			if($this->_sGroupLogic){ $sLogic = "AND"; } else { $sLogic = "OR"; }
			
			$sFilter .= " AND (";
			
			if( $this->_sHaendlerGruppe1 ){
				switch ( $this->_sHaendlerGruppe1 ) {
					case 1:
				    		$sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxiddealer'"; 	break;				       	
				   	case 2:
				       		$sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpricea'"; 	break;
				   	case 3:
				   	   		$sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpriceb'"; 	break;
					case 4:
					   		$sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpricec'";	break;
				}
				
				if( $this->_sHaendlerGruppe2 ){
					$sFilter .= " ". $sLogic ." ";
					switch ( $this->_sHaendlerGruppe2 ) {
						case 1:
					    	$sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxiddealer'"; 	break;
					    case 2:
					       $sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpricea'";	break;
					    case 3:
					   	   $sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpriceb'";	break;
					   	case 4:
						   $sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpricec'";	break;
					}
					
					if( $this->_sHaendlerGruppe3 ){
						$sFilter .= " ". $sLogic ." ";
						switch ( $this->_sHaendlerGruppe3 ) {
							case 1:
						    	$sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxiddealer'";	break;
						    case 2:
						       $sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpricea'";	break;
						    case 3:
						   	   $sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpriceb'";	break;
						   	case 4:
							   $sFilter .= "{$sViewNameObj2G}.OXGROUPSID = 'oxidpricec'";	break;
						}
					}	
				}
			}
			
			$sFilter .= ")";
		}
		
		$oGroupsActive->selectString("select {$sViewName}.OXID,
											 {$sViewName}.OXTITLE 
										from {$sViewName} 
										INNER JOIN {$sViewNameObj2G} 
										ON {$sViewName}.OXID = {$sViewNameObj2G}.OXGROUPSID
										WHERE (
												({$sViewNameObj2G}.OXOBJECTID) = '". $soxId . "'". $sFilter . ") 
										ORDER BY {$sViewName}.oxtitle"); 
		
		if( $_blCreditRatingAcive )
		{
			$blRating	= false;
			$oUser 		= oxNew("oxuser");
			$oUser		->load($soxId);
			$dBoni 		= $oUser->getFieldData("oxboni");
			
			switch( $_sCreditRatingComparison ){
				case 0:
						$blRating = ( $dboni < $_dCreditRatingValue );	break;
				case 1:
				   		$blRating = ( $dboni == $_dCreditRatingValue );	break;
				case 2:
						$blRating = ( $dboni > $_dCreditRatingValue );	break;
			}	
			
			$this->_aViewData["tes_haendleranzeige_isDealer"] 	= ( $oGroupsActive->count() && $blRating );
			
		} else {
			
			$this->_aViewData["tes_haendleranzeige_isDealer"] 	= $oGroupsActive->count();
			
		}
		
		$this->_aViewData["tes_haendleranzeige_bgcolor"] 		= $this->_sBackgroundColor;
		$this->_aViewData["tes_haendleranzeige_color"] 			= $this->_sColor;		
		
		
		if($sTpl == 'user_main.tpl'){
			return 'tes_haendleranzeige_user_main.tpl';
		} else {
			return $sTpl;
		}
	
	}

}