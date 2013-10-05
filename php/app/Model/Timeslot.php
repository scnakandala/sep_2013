<?php

App::uses('AppModel', 'Model');

/**
 * Timeslot Model
 *
 * @property ExternalEvaluator $ExternalEvaluator
 * @property InternalEvaluator $InternalEvaluator
 */
class Timeslot extends AppModel {

    /**
     * ignore fields list for the Admin plugin
     * 
     * @var type array
     */
    var $ignoreFieldList = array(
        'id'
    );
    
    /**
     * admin settings for the Admin plugin
     * 
     * @var type array
     */
    var $adminSettings = array(
        'icon' => 'wallet',
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    /*public $hasAndBelongsToMany = array(
        'AvailableExternalEvaluators' => array(
            'className' => 'ExternalEvaluator',
            'joinTable' => 'external_evaluators_timeslots',
            'foreignKey' => 'timeslot_name',
            'associationForeignKey' => 'external_evaluator_name',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'AvailableInternalEvaluators' => array(
            'className' => 'InternalEvaluator',
            'joinTable' => 'internal_evaluators_timeslots',
            'foreignKey' => 'timeslot_name',
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
    );*/

}
