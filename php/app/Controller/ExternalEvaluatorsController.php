<?php

App::uses('NonAdminAppController', 'Controller');

/**
 * ExternalEvaluators Controller
 *
 * @property ExternalEvaluator $ExternalEvaluator
 */
class ExternalEvaluatorsController extends NonAdminAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->ExternalEvaluator->recursive = 0;
        $this->set('externalEvaluators', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->ExternalEvaluator->id = $id;
        if (!$this->ExternalEvaluator->exists()) {
            throw new NotFoundException(__('Invalid external evaluator'));
        }
        $this->set('externalEvaluator', $this->ExternalEvaluator->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->ExternalEvaluator->create();
            if ($this->ExternalEvaluator->save($this->request->data)) {
                $this->Session->setFlash(__('The external evaluator has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The external evaluator could not be saved. Please, try again.'));
            }
        }
        $technologies = $this->ExternalEvaluator->Technology->find('list');
        $timeslots = $this->ExternalEvaluator->Timeslot->find('list');
        $this->set(compact('technologies', 'timeslots'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->ExternalEvaluator->id = $id;
        if (!$this->ExternalEvaluator->exists()) {
            throw new NotFoundException(__('Invalid external evaluator'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ExternalEvaluator->save($this->request->data)) {
                $this->Session->setFlash(__('The external evaluator has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The external evaluator could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->ExternalEvaluator->read(null, $id);
        }
        $technologies = $this->ExternalEvaluator->Technology->find('list');
        $timeslots = $this->ExternalEvaluator->Timeslot->find('list');
        $this->set(compact('technologies', 'timeslots'));
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
        $this->ExternalEvaluator->id = $id;
        if (!$this->ExternalEvaluator->exists()) {
            throw new NotFoundException(__('Invalid external evaluator'));
        }
        if ($this->ExternalEvaluator->delete()) {
            $this->Session->setFlash(__('External evaluator deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('External evaluator was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
