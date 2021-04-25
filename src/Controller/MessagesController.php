<?php


namespace App\Controller;

class MessagesController extends AppController
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
        $this->loadModel('Users');
        $users =  $this->Users->find('all');
        $user = $this->Users->get($id,  ['contain' => 'Messages']);
        $messages = $user->messages;
        $this->set(compact('messages', 'users'));
    }

    public function new($user_id){
        $new = $this->Messages->newEmptyEntity();

        if($this->request->is('post')){
            $new->receiver_id = $user_id;
            $new->sender_id = $this->request->getData('sender_id');
            $new->subject = $this->request->getData('subject');
            $new->content = $this->request->getData('content');
            if($this->Messages->save($new)){
                $this->Flash->success('Votre message a été envoyé');
                return $this->redirect(['controller' => 'Messages', 'action' => 'index', $this->request->getAttribute('identity')->id]);
            }else{
                $this->Flash->error('Envoie échouer');
            }
        }

        $this->set(compact('new', 'user_id'));
    }

    public function readAt($id) {
        $currDateTime = date("Y-m-d H:i:s");

        if(empty($id)) {
            return $this->redirect(['action' => 'index']);
        }

        $update = $this->Messages->findById($id);

        if($update->isEmpty()) {
            $this->Flash->error('Ce message n existe pas');
            return $this->redirect(['action' => 'index']);
        }

        $update = $update->first();

        if($this->request->is(['post', 'put', 'patch'])) {
            $update->read_at = $currDateTime;

            if($this->Messages->save($update)){
                $this->Flash->success('Lu');
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Impossible de lire');
        }
    }

    public function view($id) {
        $message = $this->Messages->get($id);

        $this->set(compact('message'));
    }
}
