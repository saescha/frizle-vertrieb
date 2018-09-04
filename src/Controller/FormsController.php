<?php
namespace App\Controller;

use App\Controller\AppController;
use \DateTime;
/**
 * Forms Controller
 *
 * @property \App\Model\Table\FormsTable $Forms
 */
class FormsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
		$query = $this->Forms->find('all',['contain' => ['Customers','Users']])->order(['Forms.created' => 'DESC']);
        if( $this->Auth->user('role') <> 'admin'){
			$query->where(['Forms.user_id =' => $this->Auth->user('id')]);
		}
		
        $forms = $this->paginate($query);

        $this->set(compact('forms'));
        $this->set('_serialize', ['forms']);
    }
	public function report(){
		$users = $this->Forms->Users->find('list');
		
		$this->set('users',$users);
		if ($this->request->is('post')) {
			$date = $this->request->data['from'];
			list ($m, $d, $y) = split('[/.-]', $date);
			$d = $d - 1;
			$from = new DateTime();
			$from->setDate($y, $m, $d);
			$date = $this->request->data['to'];
			list ($m, $d, $y) = split('[/.-]', $date);
			
			$to = new DateTime();
			$to->setDate($y, $m, $d);
			if ( $this->Auth->user('role') == 'user'){
				$user_id = $this->Auth->user('id');
			}else{
				$user_id = $this->request->data['user_id'];
			}
			
			$query = $this->Forms->find('all',
			['contain' => ['Customers', 'Users', 'Answers', 'Answers.Choices','Answers.Choices.Questions'],
			'order' => ['Forms.created' => 'DESC']
			])->where(['Forms.user_id =' => $user_id])->andWhere(['Forms.created >=' => $from])->andWhere(['Forms.created <=' => $to]);
			
			$this->set('forms', $query->toArray() );
		}
		
	}
	
	public function query(){
		$users = $this->Forms->Users->find('list');
		
		$this->set('users',$users);
		$query = $this->Forms->Answers->Choices->Questions->find('all');
		$query->contain('Choices')->where(['Questions.filterable' => true] )->all();
		/* ->contain('Choices')->where(['Questions.filterable' => true] )->all(). */
		$this->set('filters',$query);
		if ($this->request->is('post')) {
			if ( $this->Auth->user('role') == 'user'){
				$user_id = $this->Auth->user('id');
			}else{
				$user_id = $this->request->data['user_id'];
			}
			$query = $this->Forms->find('all',
			['contain' => ['Customers', 'Users', 'Answers', 'Answers.Choices'],
			'order' => ['Forms.created' => 'DESC']
			]);
			if(!empty($user_id)){
				$query->where(['Forms.user_id =' => $user_id]);
				}else{
			//	$query->where(['1 =' => '1']);
				}
			if(!empty($this->request->data['from'])){
				$date = $this->request->data['from'];
				list ($d, $m, $y) = split('[\..-]', $date);
				$d = $d - 1;
				$from = new DateTime();
				$from->setDate($y, $m, $d);
				$query->andWhere(['Forms.created >=' => $from]);
				}
			if(!empty($this->request->data['to'])){
				$date = $this->request->data['to'];
				list ($d, $m, $y) = split('[\..-]', $date);
			
				$to = new DateTime();
				$to->setDate($y, $m, $d);
				$query->andWhere(['Forms.created <=' => $to]);
				}

	
			foreach( $this->request->data['filter'] as $f ){
				if($f){
					$subquery = $this->Forms->Answers->find()->select(['Answers.form_id'])->where(['Answers.choice_id =' => $f]);
					
					$query->andWhere( ['Forms.id IN' => $subquery]);
				}
			}
			
			$forms =  $query->toArray();
			$shortQ = $this->Forms->Answers->Choices->Questions->find('all');
			$shortQ->contain('Choices')->where(['Questions.short !=' => ''] )->order(['Questions.sequence_number' => 'ASC'])->all();
			foreach($forms as $f){
				$f->shortA = array();
				foreach($shortQ as $sq){
					foreach($f->answers as $a){
						if( $a->choice->question_id == $sq->id){
							$f->shortA[$sq->id] = $a->choice->text;
						}
					}
				}
			}
			$this->set('forms', $forms );
			$this->set('shortQ', $shortQ );
		}
		
	}

    /**
     * View method
     *
     * @param string|null $id Form id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $form = $this->Forms->get($id, [
            'contain' => ['Customers', 'Users', 'Answers', 'Answers.Choices','Answers.Choices.Questions']
        ]);
		//$form->answers->contain( ['Choices' ]);

        $this->set('form', $form);
        $this->set('_serialize', ['form']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $form = $this->Forms->newEntity();
        if ($this->request->is('post')) {
            $form = $this->Forms->patchEntity($form, $this->request->data);
            if ($this->Forms->save($form)) {
                $this->Flash->success(__('The form has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The form could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Forms->Customers->find('list', ['limit' => 200]);
        $users = $this->Forms->Users->find('list', ['limit' => 200]);
        $this->set(compact('form', 'customers', 'users'));
        $this->set('_serialize', ['form']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Form id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $form = $this->Forms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $form = $this->Forms->patchEntity($form, $this->request->data);
            if ($this->Forms->save($form)) {
                $this->Flash->success(__('The form has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The form could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Forms->Customers->find('list', ['limit' => 200]);
        $users = $this->Forms->Users->find('list', ['limit' => 200]);
        $this->set(compact('form', 'customers', 'users'));
        $this->set('_serialize', ['form']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Form id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $form = $this->Forms->get($id);
        if ($this->Forms->delete($form)) {
            $this->Flash->success(__('The form has been deleted.'));
        } else {
            $this->Flash->error(__('The form could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	public function isAuthorized($user)
{
	if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
		}
    if ($this->request->action === 'report' || $this->request->action === 'index' || $this->request->action === 'query' ) {
        return true;
    }
	if ($this->request->action === 'view' || $this->request->action === 'delete') {
        $id = $this->request->pass[0];
		return ($this->Forms->get($id)->user_id == $user['id'] );
    }

    return parent::isAuthorized($user);
}
}
