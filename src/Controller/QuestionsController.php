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
	 	 	public function answer($pcustomer_id = null)
    {
     //   $this->set('questions',$this->Questions->find('all',array('order' => 'Question.sequence_number')));
		$query = $this->Questions->find('all',['contain' => ['Choices'],
											   'order' => ['Questions.sequence_number' => 'ASC'] ])->where(['Questions.inactive =' => 0])->andWhere(['Questions.customer_question =' => 0]);
		
		$this->set('pcustomer_id',$pcustomer_id);
		
		$this->set('questions',$query->toArray());

		$this->loadModel('Customers');
        $query = $this->Customers->find()->select(['name', 'street','plz','city','id']);
        if ($this->Auth->user('role') <> 'admin') {
            $query->where(['Customers.user_id =' => $this->Auth->user('id')]);
        }
        $customers = $query->toArray();
        foreach ( $customers as $c ) {
            $c->concat = strtolower (  $c->name . ' ' . $c->city ); 
        }
		
		//debug( $query->toArray() );
		$this->set('customers',$customers);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$this->loadModel('Forms');
			$form = $this->Forms->newEntity();
			if(!is_numeric($this->request->data['customer_id'])){
                // TODO: check if authorized to create form for this customer
				$this->Flash->error(__('Bitte Markt auswählen'));
				return;
			}
			$form->customer_id = $this->request->data['customer_id'];
			$form->user_id = $this->Auth->user('id');
			unset($this->request->data['customer_id']);
			
			if ( $this->Forms->save($form) ){
				
				$this->loadModel('Answers');
				foreach( $this->request->data as $k => $d ){
					if( !empty($d)){

					if(is_int( $k ) ){

					$q = $this->Questions->get( $k );
					if ( $q->type == 'F' ){
						$choice = $this->Questions->Choices->newEntity();
						$choice->question_id = $k;
						$choice->text = $d;
						
						if($this->Questions->Choices->save($choice)){
						}
						$choice_id = $choice->id;
					}
					else{
						$choice_id = $d;
					}
					}else{
						$choice_id = $d;
					}
					$answer = $this->Answers->newEntity();
					$answer->form_id = $form->id;
					$answer->choice_id = $choice_id;
					$this->Answers->save($answer);
					
				}
				}
			}else{
			
             $this->Flash->error(__('Kontaktformular konnte nicht gespeichert werden'));
			 }
			 $this->Flash->success(__('Kontaktformular gespeichert.'));
            return $this->redirect(['controller' => 'Forms', 'action' => 'view',$form->id]);
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
