<?php
namespace App\Model\Table;

use App\Model\Entity\Question;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \Cake\ORM\Association\HasMany $Choices
 */
class QuestionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('questions');
        $this->displayField('text');
        $this->primaryKey('id');

        $this->hasMany('Choices', [
            'foreignKey' => 'question_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('text', 'create')
            ->notEmpty('text');

        $validator
            ->integer('sequence_number')
            ->requirePresence('sequence_number', 'create')
            ->notEmpty('sequence_number');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->boolean('inactive')
            ->requirePresence('inactive', 'create')
            ->notEmpty('inactive');
		$validator
            ->boolean('customer_question');
		$validator
			->add('type', 'inList', [
                'rule' => ['inList', ['F', 'C','R']],
                'message' => 'Nur (F)reitext (C)heckbox oder (R)adiobutton erlaubt'
            ]);

        return $validator;
    }
}
