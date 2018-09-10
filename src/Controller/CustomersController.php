<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $query = $this->Customers->find('all', ['contain' => ['Users','Categories']]);
        if ($this->Auth->user('role') <> 'admin') {
            $query->where(['Customers.user_id =' => $this->Auth->user('id')]);
        }
        
        $customers = $this->paginate($query);

        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
    }
    
    public function search()
    {
        if ($this->request->is('post')) {
            return $this->redirect(['action' => 'view',$this->request->data['customer_id']]);
        }
        $query = $this->Customers->find()->select(['name', 'street','plz','city','id']);
        if ($this->Auth->user('role') <> 'admin') {
            $query->where(['Customers.user_id =' => $this->Auth->user('id')]);
        }
        $this->set('customers', $query->toArray());
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Users', 'Forms' => ['sort' => ['Forms.created' => 'DESC'] ],'Events','Persons','Categories', 'Answers', 'Answers.Choices','Answers.Choices.Questions']
        ]);

        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Questions');
        
        
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data['Customer']);
            if ($this->Auth->user('role') == 'user') {
                $customer->user_id = $this->Auth->user('id');
            }
            if ($this->Customers->save($customer)) {
                $this->loadModel('Answers');
                foreach ($this->request->data['FQuestion'] as $k => $d) {
                    if (!empty($d)) {
                        $choice = $this->Questions->Choices->newEntity();
                        $choice->question_id = $k;
                        $choice->text = $d;
                        $this->Questions->Choices->save($choice);
                        $answer = $this->Answers->newEntity();
                        $answer->customer_id = $customer->id;
                        $answer->choice_id = $choice->id;
                        $this->Answers->save($answer);
                    }
                }
                foreach ($this->request->data['Question'] as $k => $d){
                    if (!empty($d)) {
                        $answer = $this->Answers->newEntity();
                        $answer->customer_id = $customer->id;
                        $answer->choice_id = $d;
                        $this->Answers->save($answer);
                    }
                }
                $this->Flash->success(__('Der Markt wurde gespeichert'));
                return $this->redirect(['action' => 'view',$customer->id]);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $users = $this->Customers->Users->find('list', ['limit' => 200]);
        $categories = $this->Customers->Categories->find('list', ['limit' => 200]);
        $query = $this->Questions->find('all', ['contain' => ['Choices'],
                                               'order' => ['Questions.sequence_number' => 'ASC'] ])->where(['Questions.inactive =' => 0])->andWhere(['Questions.customer_question =' => 1]);
        $this->set('questions', $query->toArray());
        $this->set(compact('customer', 'users', 'categories'));
        $this->set(compact('customer', 'users'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $GLOBALS['customer_id'] = $id;
        $this->loadModel('Questions');

        $customer = $this->Customers->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data['Customer']);
            if ($this->Customers->save($customer)) {
                $this->loadModel('Answers');
                $this->Answers->deleteAll(['customer_id = ' => $customer->id]);
                foreach ($this->request->data['FQuestion'] as $k => $d) {
                    if (!empty($d)) {
                        $choice = $this->Questions->Choices->newEntity();
                        $choice->question_id = $k;
                        $choice->text = $d;
                        $this->Questions->Choices->save($choice);
                        $answer = $this->Answers->newEntity();
                        $answer->customer_id = $customer->id;
                        $answer->choice_id = $choice->id;
                        $this->Answers->save($answer);
                    }
                }
                foreach ($this->request->data['Question'] as $k => $d){
                    if (!empty($d)) {
                        $answer = $this->Answers->newEntity();
                        $answer->customer_id = $customer->id;
                        $answer->choice_id = $d;
                        $this->Answers->save($answer);
                    }
                }
                
                
                $this->Flash->success(__('Der Markt wurde gespeichert.'));
                return $this->redirect(['action' => 'view',$customer->id]);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $query = $this->Questions->find('all', ['contain' => ['Choices','Choices.Answers' => function ($q) {
            return $q->where(['Answers.customer_id = ' => $GLOBALS['customer_id']]);
        }],
                                               'order' => ['Questions.sequence_number' => 'ASC'] ])->where(['Questions.inactive =' => 0])->andWhere(['Questions.customer_question =' => 1]);
        $this->set('questions', $query->toArray());
        $users = $this->Customers->Users->find('list', ['limit' => 200]);
        $categories = $this->Customers->Categories->find('list', ['limit' => 200]);
        $this->set(compact('users', 'categories'));

        $deepCustomer['Customer'] = $customer;
        $this->set('Customer',$deepCustomer);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('Der Markt wurde gelöscht'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
    {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        if ($this->request->action === 'add' || $this->request->action === 'index' || $this->request->action === 'search') {
            return true;
        }
        if ($this->request->action === 'view' || $this->request->action === 'delete' || $this->request->action === 'edit') {
            $id = $this->request->pass[0];
            return ($this->Customers->get($id)->user_id == $user['id']);
        }

        return parent::isAuthorized($user);
    }
}
