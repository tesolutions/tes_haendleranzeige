<?php

$sMetadataVersion = '1.1';
 
$aModule = array(
    'id'           => 'tes_haendleranzeige',
    'title'        => '<img src="../modules/tes_haendleranzeige/out/img/tes_icon.png" width="15" height="15"> TESolutions - Händleranzeige',
    'description'  => 'Zeigt in der Backend-Benutzerverwaltung an, ob ein Benutzer ein B2B-Kunde ist. Abhängig von der Gruppenzuweisung oder des Bonitätswertes kann die Formatierung geändert werden.',
    'thumbnail'    => 'out/img/tesolutions.jpg',
    'version'      => '1.1',
    'author'       => 'Fabian Kaufmann',
    'url'          => 'http://www.te-solutions.de',
    'email'        => 'f.kaufmann@te-solutions.de',
    
    'extend'       => array(
    	'user_main'		=> 'tes_haendleranzeige/controllers/admin/tes_haendleranzeige_user_main',
    ),
    'templates'   		=> array(
        'tes_haendleranzeige_user_main.tpl'  => 'tes_haendleranzeige/views/admin/tpl/tes_haendleranzeige_user_main.tpl',
    ),
    'settings'       	=> array(
        array(
            'group'     => 'credit',
            'name'      => 'blCreditRatingAcive',
            'type'      => 'bool',
            'value'     => 'false'
        ),
        array(
        	'group' 	=> 'credit',
        	'name' 		=> 'sCreditRatingComparison',
        	'type' 		=> 'select',
        	'value' 	=> '0',
        	'constraints' => '0|1|2',
        	'position' 	=> 2 
        	),
        array(
            'group'     => 'credit',
            'name'      => 'dCreditRatingValue',
            'type'      => 'str',
            'value'     => '1000'
        ),
        array(
            'group'     => 'groups',
            'name'      => 'blGroupsAcive',
            'type'      => 'bool',
            'value'     => 'true'
        ),
        array(
        	'group' 	=> 'groups',
        	'name' 		=> 'sGroupLogic',
        	'type' 		=> 'select',
        	'value' 	=> '0',
        	'constraints' => '0',
        	'position' 	=> 0
        	),
        array(
        	'group' 	=> 'groups',
        	'name' 		=> 'sHaendlerGruppe1',
        	'type' 		=> 'select',
        	'value' 	=> '1',
        	'constraints' => '0|1|2|3|4',
        	'position' 	=> 4
        	),
    	array(
    		'group' 	=> 'groups',
    		'name' 		=> 'sHaendlerGruppe2',
    		'type' 		=> 'select',
    		'value' 	=> '0',
    		'constraints' => '0|1|2|3|4',
    		'position' 	=> 4
    		),
    	array(
    		'group' 	=> 'groups',
    		'name' 		=> 'sHaendlerGruppe3',
    		'type' 		=> 'select',
    		'value' 	=> '0',
    		'constraints' => '0|1|2|3|4',
    		'position' 	=> 4 
    		),
		array(
			'group' 	=> 'display',
			'name' 		=> 'sBackgroundColor',
			'type'      => 'str',
			'value'     => '#F1F5EF'
			),
		array(
			'group' 	=> 'display',
			'name' 		=> 'sColor',
			'type'      => 'str',
			'value'     => '#49D000'
			),
			
    )
);
