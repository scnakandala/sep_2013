<?php

App::uses('AppModel', 'Model');

/**
 * InternalEvaluator Model
 *
 * @property Timeslot $Timeslot
 * @property Student $Student
 */
class InternalEvaluator extends AppModel {

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
        'AvailableTimeslots' => array(
            'className' => 'Timeslot',
            'joinTable' => 'internal_evaluators_timeslots',
            'foreignKey' => 'internal_evaluator_name',
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
        ),
        'MidEvaluatedStudents' => array(
            'className' => 'Student',
            'joinTable' => 'students_internal_evaluators',
            'foreignKey' => 'internal_evaluator_name',
            'associationForeignKey' => 'student_index_number',
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
