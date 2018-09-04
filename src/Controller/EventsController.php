<?php
namespace App\Controller;

use App\Controller\AppController;
use \DateTime;
/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers','Users']
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Customers','Users']
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($pcustomer_id=null)
    {
		$this->set('pcustomer_id',$pcustomer_id);
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
			if(!empty($this->request->data['datepick'])){
				$date = $this->request->data['datepick'];
				list ($d, $m, $y) = split('[\..-]', $date);
				$event->date = new DateTime();
				$event->date->setDate($y, $m, $d);
				}
			$event->user_id = $this->Auth->user('id');
			$event->status = 'N';
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $query = $this->Events->Customers->find();
		if( $this->Auth->user('role') <> 'admin'){
			$query->where(['Customers.user_id =' => $this->Auth->user('id')]);
		}
		$this->set('customers',$query->toArray());
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
			if(!empty($this->request->data['datepick'])){
				$date = $this->request->data['datepick'];
				list ($d, $m, $y) = split('[\..-]', $date);
				$event->date = new DateTime();
				$event->date->setDate($y, $m, $d);
				}
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function isAuthorized($user)
	{
		if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
		}
		if ($this->request->action === 'add' || $this->request->action === 'index') {
			return true;
		}
		if ($this->request->action === 'view' || $this->request->action === 'delete' || $this->request->action === 'edit') {
			$id = $this->request->pass[0];
			return true;
			return ($this->Events->get($id, ['contain' => ['customers']])->Customers[0]->user_id == $user['id'] );
		}
	
		return parent::isAuthorized($user);
	}      
}
