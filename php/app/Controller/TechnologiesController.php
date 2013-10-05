<?php

App::uses('NonAdminAppController', 'Controller');

/**
 * Technologies Controller
 *
 * @property Technology $Technology
 */
class TechnologiesController extends NonAdminAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Technology->recursive = 0;
        $this->set('technologies', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Technology->id = $id;
        if (!$this->Technology->exists()) {
            throw new NotFoundException(__('Invalid technology'));
        }
        $this->set('technology', $this->Technology->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Technology->create();
            if ($this->Technology->save($this->request->data)) {
                $this->Session->setFlash(__('The technology has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The technology could not be saved. Please, try again.'));
            }
        }
        $externalEvaluators = $this->Technology->ExternalEvaluator->find('list');
        $students = $this->Technology->Student->find('list');
        $this->set(compact('externalEvaluators', 'students'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Technology->id = $id;
        if (!$this->Technology->exists()) {
            throw new NotFoundException(__('Invalid technology'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Technology->save($this->request->data)) {
                $this->Session->setFlash(__('The technology has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The technology could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Technology->read(null, $id);
        }
        $externalEvaluators = $this->Technology->ExternalEvaluator->find('list');
        $students = $this->Technology->Student->find('list');
        $this->set(compact('externalEvaluators', 'students'));
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
        $this->Technology->id = $id;
        if (!$this->Technology->exists()) {
            throw new NotFoundException(__('Invalid technology'));
        }
        if ($this->Technology->delete()) {
            $this->Session->setFlash(__('Technology deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Technology was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
