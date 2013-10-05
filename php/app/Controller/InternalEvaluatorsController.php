<?php

App::uses('NonAdminAppController', 'Controller');

/**
 * InternalEvaluators Controller
 *
 * @property InternalEvaluator $InternalEvaluator
 */
class InternalEvaluatorsController extends NonAdminAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->InternalEvaluator->recursive = 0;
        $this->set('internalEvaluators', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->InternalEvaluator->id = $id;
        if (!$this->InternalEvaluator->exists()) {
            throw new NotFoundException(__('Invalid internal evaluator'));
        }
        $this->set('internalEvaluator', $this->InternalEvaluator->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->InternalEvaluator->create();
            if ($this->InternalEvaluator->save($this->request->data)) {
                $this->Session->setFlash(__('The internal evaluator has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The internal evaluator could not be saved. Please, try again.'));
            }
        }
        $timeslots = $this->InternalEvaluator->Timeslot->find('list');
        $students = $this->InternalEvaluator->Student->find('list');
        $this->set(compact('timeslots', 'students'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->InternalEvaluator->id = $id;
        if (!$this->InternalEvaluator->exists()) {
            throw new NotFoundException(__('Invalid internal evaluator'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->InternalEvaluator->save($this->request->data)) {
                $this->Session->setFlash(__('The internal evaluator has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The internal evaluator could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->InternalEvaluator->read(null, $id);
        }
        $timeslots = $this->InternalEvaluator->Timeslot->find('list');
        $students = $this->InternalEvaluator->Student->find('list');
        $this->set(compact('timeslots', 'students'));
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
        $this->InternalEvaluator->id = $id;
        if (!$this->InternalEvaluator->exists()) {
            throw new NotFoundException(__('Invalid internal evaluator'));
        }
        if ($this->InternalEvaluator->delete()) {
            $this->Session->setFlash(__('Internal evaluator deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Internal evaluator was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
