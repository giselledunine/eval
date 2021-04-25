<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ItemsTable extends Table
{


    public function initialize(array $c): void
    {
        parent::initialize($c);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Todolists', [
            'foreignKey' => 'lists_id',
            'joinType' => 'INNER'
        ]);

    }
}
