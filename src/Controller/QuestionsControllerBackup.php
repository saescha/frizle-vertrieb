<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 */
class QuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	 	public function answer()
    {
     //   $this->set('questions',$this->Questions->find('all',array('order' => 'Question.sequence_number')));
		$query = $this->Questions->find('all',['contain' => ['Choices'] ]);
		
		$this->set('questions',$query->toArray());

		$this->loadModel('Customers');
		$query = $this->Customers->find();
		
		//debug( $query->toArray() );
		$this->set('customers',$query->toArray());
		if ($this->request->is(['patch', 'post', 'put'])) {
			
			
			$this->loadModel('Forms');
			$form = $this->Forms->newEntity();
			$form->customer_id = $this->request->data['customer_id'];
			$form->user_id = $this->Auth->user('id');
			unset($this->request->data['customer_id']);
			
			if ( $this->Forms->save($form) ){
				
				$this->loadModel('Answers');
				foreach( $this->request->data as $k => $d ){
					
					$answer = $this->Answers->newEntity();
					$answer->form_id = $form->id;
					$answer->choice_id = $d;
					$this->Answers->save($answer);
				}
			}else{
			
             $this->Flash->error(__('The user could not be saved. Please, try again.'));
			 }
			 $this->Flash->success(__('Kontakt gespeichert.'));
             return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
        }

    }
    public function index()
    {
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
        $this->set('_serialize', ['questions']);
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Choices']
        ]);

        $this->set('question', $question);
        $this->set('_serialize', ['question']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function isAuthorized($user)
{

    if ($this->request->action === 'answer') {
        return true;
    }

    return parent::isAuthorized($user);
}
}
