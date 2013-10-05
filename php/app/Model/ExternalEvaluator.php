<?php

App::uses('AppModel', 'Model');

/**
 * ExternalEvaluator Model
 *
 * @property Technology $Technology
 * @property Timeslot $Timeslot
 */
class ExternalEvaluator extends AppModel {

    /**
     * List of ignore fields
     * 
     * @var type array
     */
    var $ignoreFieldList = array(
        'id'
    );

    /**
     * Admin plugin settings
     * 
     * @var type arrya
     */
    var $adminSettings = array(
        'icon' => 'communityhelp',
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
        'gmail_address' => array(
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
        'CompetentTechnologies' => array(
            'className' => 'Technology',
            'joinTable' => 'external_evaluators_technologies',
            'foreignKey' => 'external_evaluator_name',
            'associationForeignKey' => 'technology_name',
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
        'AvailableTimeslots' => array(
            'className' => 'Timeslot',
            'joinTable' => 'external_evaluators_timeslots',
            'foreignKey' => 'external_evaluator_name',
            'associationForeignKey' => 'timeslot_name',
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
