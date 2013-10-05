<?php

App::uses('AppModel', 'Model');

/**
 * Technology Model
 *
 * @property ExternalEvaluator $ExternalEvaluator
 * @property Student $Student
 */
class Technology extends AppModel {

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
        'icon' => 'services',
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
        'CompetentExternalEvaluators' => array(
            'className' => 'ExternalEvaluator',
            'joinTable' => 'external_evaluators_technologies',
            'foreignKey' => 'technology_name',
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
        'UsedStudents' => array(
            'className' => 'Student',
            'joinTable' => 'students_technologies',
            'foreignKey' => 'technology_name',
            'associationForeignKey' => 'student_name',
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
