<?php

App::uses('NonAdminAppController', 'Controller');

/**
 * Timeslots Controller
 *
 * @property Timeslot $Timeslot
 */
class TimeslotsController extends NonAdminAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Timeslot->recursive = 0;
        $this->set('timeslots', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Timeslot->id = $id;
        if (!$this->Timeslot->exists()) {
            throw new NotFoundException(__('Invalid timeslot'));
        }
        $this->set('timeslot', $this->Timeslot->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Timeslot->create();
            if ($this->Timeslot->save($this->request->data)) {
                $this->Session->setFlash(__('The timeslot has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The timeslot could not be saved. Please, try again.'));
            }
        }
        $externalEvaluators = $this->Timeslot->ExternalEvaluator->find('list');
        $internalEvaluators = $this->Timeslot->InternalEvaluator->find('list');
        $this->set(compact('externalEvaluators', 'internalEvaluators'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Timeslot->id = $id;
        if (!$this->Timeslot->exists()) {
            throw new NotFoundException(__('Invalid timeslot'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Timeslot->save($this->request->data)) {
                $this->Session->setFlash(__('The timeslot has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The timeslot could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Timeslot->read(null, $id);
        }
        $externalEvaluators = $this->Timeslot->ExternalEvaluator->find('list');
        $internalEvaluators = $this->Timeslot->InternalEvaluator->find('list');
        $this->set(compact('externalEvaluators', 'internalEvaluators'));
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
        $this->Timeslot->id = $id;
        if (!$this->Timeslot->exists()) {
            throw new NotFoundException(__('Invalid timeslot'));
        }
        if ($this->Timeslot->delete()) {
            $this->Session->setFlash(__('Timeslot deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Timeslot was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
