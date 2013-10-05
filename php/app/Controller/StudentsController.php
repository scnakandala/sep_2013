<?php

App::uses('NonAdminAppController', 'Controller');

/**
 * Students Controller
 *
 * @property Student $Student
 */
class StudentsController extends NonAdminAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Student->recursive = 0;
        $this->set('students', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Student->id = $id;
        if (!$this->Student->exists()) {
            throw new NotFoundException(__('Invalid student'));
        }
        $this->set('student', $this->Student->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Student->create();
            if ($this->Student->save($this->request->data)) {
                $this->Session->setFlash(__('The student has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The student could not be saved. Please, try again.'));
            }
        }
        $internalEvaluators = $this->Student->InternalEvaluator->find('list');
        $technologies = $this->Student->Technology->find('list');
        $this->set(compact('internalEvaluators', 'technologies'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Student->id = $id;
        if (!$this->Student->exists()) {
            throw new NotFoundException(__('Invalid student'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Student->save($this->request->data)) {
                $this->Session->setFlash(__('The student has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The student could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Student->read(null, $id);
        }
        $internalEvaluators = $this->Student->InternalEvaluator->find('list');
        $technologies = $this->Student->Technology->find('list');
        $this->set(compact('internalEvaluators', 'technologies'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Student->id = $id;
        if (!$this->Student->exists()) {
            throw new NotFoundException(__('Invalid student'));
        }
        if ($this->Student->delete()) {
            $this->Session->setFlash(__('Student deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Student was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
