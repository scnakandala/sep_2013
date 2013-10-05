<?php

App::uses('AppModel', 'Model');

/**
 * PanelMotiff Model
 *
 * @property InternalEvaluator $InternalEvaluator
 */
class PanelMotiff extends AppModel {

    /**
     * Ignore field  list for the Admin plugin
     *  
     * @var type array
     */
    var $ignoreFieldList = array(
        'id'
    );

    /**
     * Admin settings for the Admin plugin
     * 
     * @var type array
     */
    var $adminSettings = array(
        'icon' => 'blog',
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'InternalEvaluator' => array(
            'className' => 'InternalEvaluator',
            'joinTable' => 'panel_motiffs_internal_evaluators',
            'foreignKey' => 'panel_motiff_id',
            'associationForeignKey' => 'internal_evaluator_name',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );

}
