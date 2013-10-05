<?php

App::uses('NonAdminAppController', 'Controller');

/**
 * PanelMotiffs Controller
 *
 * @property PanelMotiff $PanelMotiff
 */
class PanelMotiffsController extends NonAdminAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->PanelMotiff->recursive = 0;
        $this->set('panelMotiffs', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->PanelMotiff->id = $id;
        if (!$this->PanelMotiff->exists()) {
            throw new NotFoundException(__('Invalid panel motiff'));
        }
        $this->set('panelMotiff', $this->PanelMotiff->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PanelMotiff->create();
            if ($this->PanelMotiff->save($this->request->data)) {
                $this->Session->setFlash(__('The panel motiff has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The panel motiff could not be saved. Please, try again.'));
            }
        }
        $internalEvaluators = $this->PanelMotiff->InternalEvaluator->find('list');
        $this->set(compact('internalEvaluators'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->PanelMotiff->id = $id;
        if (!$this->PanelMotiff->exists()) {
            throw new NotFoundException(__('Invalid panel motiff'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->PanelMotiff->save($this->request->data)) {
                $this->Session->setFlash(__('The panel motiff has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The panel motiff could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->PanelMotiff->read(null, $id);
        }
        $internalEvaluators = $this->PanelMotiff->InternalEvaluator->find('list');
        $this->set(compact('internalEvaluators'));
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
        $this->PanelMotiff->id = $id;
        if (!$this->PanelMotiff->exists()) {
            throw new NotFoundException(__('Invalid panel motiff'));
        }
        if ($this->PanelMotiff->delete()) {
            $this->Session->setFlash(__('Panel motiff deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Panel motiff was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
