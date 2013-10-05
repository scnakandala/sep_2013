<?php

App::uses('AppModel', 'Model');

/**
 * Student Model
 *
 * @property InternalEvaluator $InternalEvaluator
 * @property Technology $Technology
 */
class Student extends AppModel {
    
    /**
     * ignore fields list for the Admin plugin
     * 
     * @var type array
     */
    var $ignoreFieldList = array(
        'id'
    );
    
    /**
     * admin settings for the admin plugin
     * 
     * @var type array
     */
    var $adminSettings = array(
        'icon' => 'user',
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'index_number' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
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
        'mid_marks' => array(
            'numeric' => array(
                'rule' => array('numeric'),
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
        'MidEvaluatedInternalEvaluators' => array(
            'className' => 'InternalEvaluator',
            'joinTable' => 'students_internal_evaluators',
            'foreignKey' => 'student_index_number',
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
        ),
        'UsedTechnologies' => array(
            'className' => 'Technology',
            'joinTable' => 'students_technologies',
            'foreignKey' => 'student_name',
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
        )
    );*/

}
