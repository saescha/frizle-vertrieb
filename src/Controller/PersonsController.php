<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Persons Controller
 *
 * @property \App\Model\Table\PersonsTable $Persons
 */
class PersonsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers']
        ];
        $persons = $this->paginate($this->Persons);

        $this->set(compact('persons'));
        $this->set('_serialize', ['persons']);
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $person = $this->Persons->get($id, [
            'contain' => ['Customers']
        ]);

        $this->set('person', $person);
        $this->set('_serialize', ['person']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($pcustomer_id=null)
    {
		$this->set('pcustomer_id',$pcustomer_id);
        $person = $this->Persons->newEntity();
        if ($this->request->is('post')) {
            $person = $this->Persons->patchEntity($person, $this->request->data);
            if ($this->Persons->save($person)) {
                $this->Flash->success(__('Die Kontaktperson wurde erstellt'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Die Kontaktperson konnte nicht erstellt werden'));
            }
        }
        $query = $this->Persons->Customers->find();
		if( $this->Auth->user('role') <> 'admin'){
			$query->where(['Customers.user_id =' => $this->Auth->user('id')]);
		}
		$this->set('customers',$query->toArray());
		
        $this->set(compact('person'));
        $this->set('_serialize', ['person']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $person = $this->Persons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $person = $this->Persons->patchEntity($person, $this->request->data);
            if ($this->Persons->save($person)) {
                $this->Flash->success(__('Die Kontaktperson wurde gespeichert'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('person' ));
        $this->set('_serialize', ['person']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $person = $this->Persons->get($id);
        if ($this->Persons->delete($person)) {
            $this->Flash->success(__('Die Kontaktperson wurde gelöscht'));
        } else {
            $this->Flash->error(__('The person could not be deleted. Please, try again.'));
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
			return ($this->Persons->get($id, ['contain' => ['customers']])->Customers[0]->user_id == $user['id'] );
		}
	
		return parent::isAuthorized($user);
	}            
}
