<?php


namespace App\Controller;

class TodolistsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        //autorise l'action login et add de ce controller seulement
        $this->Authentication->addUnauthenticatedActions(['index']);
    }

    public function index()
    {
        $id = $this->request->getAttribute('identity')->id;
        $lists = $this->Todolists->find('all');
        $this->set(compact('lists'));
    }

    public function view($id) {
        $this->loadModel('Users');
        $user = $this->Users->get($id, ['contain' => ['Todolists']]);
        $this->set(compact('user'));
    }

    public function new()
    {
        $new = $this->Todolists->newEmptyEntity();

        if ($this->request->is('post')) {
            $new->title = $this->request->getData('title');
            $new->visibility = $this->request->getData('visibility');
            $new->user_id = $this->request->getAttribute('identity')->id;
            if (!empty($this->request->getData('picture')->getClientFilename()) || !in_array($this->request->getData('picture')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
                $ext = pathinfo($this->request->getData('picture')->getClientFilename(), PATHINFO_EXTENSION);
                $newName = 'pict-'.time().'-'.rand(0,9999999).'.'.$ext;
                $new->picture = $newName;
            }
            if ($this->Todolists->save($new)) {
                $this->request->getData('picture')->moveTo(WWW_ROOT.'img/data/pictures/'.$newName);
                $this->Flash->success('La listé a été ajouté');
                return $this->redirect(['controller' => 'Todolists', 'action' => 'view', $this->request->getAttribute('identity')->id]);
            } else {
                $this->Flash->error("La liste n'a pas pu être ajouté");
            }
        }

        $this->set(compact('new'));
    }

    public function copy($id) {
        $list = $this->Todolists->get($id, ['contain' => ['Items']]);
        $this->loadModel('Items');
        $this->loadModel('Copies');
        $newlist = $this->Todolists->newEmptyEntity();
        $newlist->picture = $list->picture;
        $newlist->title = $list->title;
        $newlist->user_id = $this->request->getAttribute('identity')->id;

        if ($this->Todolists->save($newlist)) {
            $this->Flash->success('La listé a été ajouté');
            foreach ($list->items as $item){
                $newItems = $this->Items->newEmptyEntity();

                $newItems->content = $item->content;
                $newItems->deadline = $item->deadline;
                $newItems->list_id = $newlist->id;

                if ($this->Items->save($newItems)){
                    $this->Flash->success('Les items ont été ajoutés');

                }else {
                    $this->Flash->error("Les éléments n'ont pas pu être ajouté");
                }
            }

        } else {
            $this->Flash->error("La liste n'a pas pu être ajouté");
        }
        $copy = $this->Copies->newEmptyEntity();
        $copy->origin_id = $id;
        $copy->newlist_id = $newlist->id;
        if ($this->Copies->save($copy)) {
            $this->Flash->success('La a été copié');
        }else {
            $this->Flash->error("Les éléments n'ont pas pu être copié");
        }
        return $this->redirect(['controller' => 'Todolists', 'action' => 'view', $this->request->getAttribute('identity')->id]);
    }

    public function update($id = null) {
    if(empty($id)) {
        return $this->redirect(['action' => 'index']);
    }

    $update = $this->Todolists->findById($id);

    if($update->isEmpty()) {
        $this->Flash->error('Cette liste nexiste pas');
        return $this->redirect(['action' => 'index']);
    }

    $update = $update->first();

    //si on est en post
        if($this->request->is(['post', 'put', 'patch'])) {
            $update->title = $this->request->getData('title');
            $update->visibility = $this->request->getData('visibility');
            if($this->request->getData('picture')->getClientFilename()){
                $ext = pathinfo($this->request->getData('picture')->getClientFilename(), PATHINFO_EXTENSION);
                $newName = 'pict-'.time().'-'.rand(0,9999999).'.'.$ext;
                $update->picture = $newName;
            }

            if($this->Todolists->save($update)){
                if($this->request->getData('picture')->getClientFilename()){
                    $this->request->getData('picture')->moveTo(WWW_ROOT.'img/data/pictures/'.$newName);
                }
                $this->Flash->success('Modifié');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Impossible de modifier');
        }

    $this->set(compact('update'));
}

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $track = $this->Todolists->get($id);

        if ($this->Todolists->delete($track)) {
            $this->Flash->success('Listse supprimée');
        } else {
            $this->Flash->error('Impossible de supprimer la liste');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function details($id) {
        $list = $this->Todolists->get($id, ['contain' => ['Items']]);
        $this->loadModel('Items');
        $newItem = $this->Items->newEmptyEntity();
        $editItem = $this->Items->find('all');
        $this->set(compact('list', 'newItem', 'editItem'));
    }

}
