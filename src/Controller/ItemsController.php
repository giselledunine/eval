<?php


namespace App\Controller;

class ItemsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        //autorise l'action login et add de ce controller seulement
        $this->Authentication->addUnauthenticatedActions(['index']);
    }


    public function new($id)
    {
        $new = $this->Items->newEmptyEntity();

        if($this->request->is('post')) {
            $new = $this->Items->patchEntity($new, $this->request->getData());
            if($this->Items->save($new)){
                $this->Flash->success('Tâche sauvegardé !');

                return $this->redirect(['controller' => 'Todolists', 'action' => 'details', $id]);
            }
            $this->Flash->error('Sauvegarde impossible, essaie encore');

        }// fin recup form

        $this->set(compact('new'));
    }

        public function edit($id, $id_user) {
            $item = $this->Items->get($id);
            if ($this->request->is(['post', 'put'])) {
                $this->Items->patchEntity($item, $this->request->getData());
                if ($this->Items->save($item)) {
                    $this->Flash->success(__('Votre article a été mis à jour.'));
                    return $this->redirect(['controller' => 'Todolists','action' => 'details', $id_user]);
                }
                $this->Flash->error(__('Impossible de mettre à jour votre article.'));
            }

            $this->set(compact('item'));
        }

    public function delete($id = null, $list_id) {
        $this->request->allowMethod(['post', 'delete']);
        $track = $this->Items->get($id);

        if ($this->Items->delete($track)) {
            $this->Flash->success('Tâche supprimée');
        } else {
            $this->Flash->error('Impossible de supprimer la tâche');
        }

        return $this->redirect(['controller'=> 'Todolists', 'action' => 'details', $list_id]);
    }

}
