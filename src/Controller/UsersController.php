<?php

namespace App\Controller;
use Cake\Datasource\ConnectionManager;

class UsersController extends AppController{

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        //autorise l'action login et add de ce controller seulement
        $this->Authentication->addUnauthenticatedActions(['login', 'new', 'index', 'details']);
    }

    public function index(){
        $users = $this->Users->find('all');

        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT COUNT(*) as number, user_id, users.username FROM Todolists LEFT JOIN users ON user_id = users.id GROUP BY user_id ORDER BY number DESC LIMIT 5')->fetchAll('assoc');
        $checked = $connection->execute('SELECT COUNT(*) as number, user_id, users.username, items.id FROM items LEFT JOIN Todolists ON list_id = todolists.id LEFT JOIN users ON todolists.user_id = users.id WHERE items.status = true GROUP BY user_id ORDER BY number DESC LIMIT 5')->fetchAll('assoc');
        $copies = $connection->execute('SELECT COUNT(*) as number, todolists.title, users.username FROM copies LEFT JOIN Todolists ON origin_id = todolists.id LEFT JOIN users ON todolists.user_id = users.id GROUP BY origin_id ORDER BY number DESC LIMIT 5')->fetchAll('assoc');
        $this->set(compact('users', 'results', 'checked', 'copies'));
    }


    public function new(){
        $t = $this->Users->find('all');
        $new = $this->Users->newEmptyEntity();

       if($this->request->is('post')){
           $new->username = $this->request->getData('username');
           $new->password = $this->request->getData('password');
           if (!empty($this->request->getData('avatar')->getClientFilename()) || !in_array($this->request->getData('avatar')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
               $ext = pathinfo($this->request->getData('avatar')->getClientFilename(), PATHINFO_EXTENSION);
               $newName = 'avatar-'.time().'-'.rand(0,9999999).'.'.$ext;
               $new->avatar = $newName;
           }
             if($this->Users->save($new)){
                 $this->request->getData('avatar')->moveTo(WWW_ROOT.'img/data/pictures/'.$newName);
                $this->Flash->success('Bienvenue');
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }else{
                $this->Flash->error('Try again');
            }
        }

        $this->set(compact('new'));
        $this->set(compact('t'));
    }

    public function details($id) {
        $user = $this->Users->get($id, ['contain' => ['Todolists.Items']]);
        $this->set(compact('user'));
    }

    public function options($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function update($id = null) {
        if(empty($id)) {
            return $this->redirect(['action' => 'index']);
        }

        $update = $this->Users->findById($id);

        if($update->isEmpty()) {
            $this->Flash->error('Cette liste nexiste pas');
            return $this->redirect(['action' => 'index']);
        }

        $update = $update->first();

        //si on est en post
        if($this->request->is(['post', 'put', 'patch'])) {
            $update->username = $this->request->getData('username');
            if(!empty($this->request->getData('newpassword'))){
                $update->password = $this->request->getData('newpassword');
            }
            if (!empty($this->request->getData('avatar')->getClientFilename()) || !in_array($this->request->getData('avatar')->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
                $ext = pathinfo($this->request->getData('avatar')->getClientFilename(), PATHINFO_EXTENSION);
                $newName = 'avatar-'.time().'-'.rand(0,9999999).'.'.$ext;
                $update->avatar = $newName;
            }

            if($this->Users->save($update)){
                $this->request->getData('avatar')->moveTo(WWW_ROOT.'img/data/pictures/'.$newName);
                $this->Flash->success('Modifié');
                return $this->redirect(['action' => 'logout']);
            }
            $this->Flash->error('Impossible de modifier');
        }

        $this->set(compact('update'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $track = $this->Users->get($id);

        if ($this->Users->delete($track)) {

            $this->Authentication->logout();
            $this->Flash->success('Le compte a été supprimé');
        } else {
            $this->Flash->error('Impossible de supprimer l\'image');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login(){
        if($this->request->is(['post'])){

            $res = $this->Authentication->getResult();
            var_dump($res, $this->request->getData());
            if($res->isValid()){
                $this->Flash->success('Welcome back');
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }else{
                $this->Flash->error('Identifiants incorrects');
            }
        }
    }

    public function logout(){
        $result = $this->Authentication->getResult();
        $this->Authentication->logout();
        $this->Flash->success('Au revoir');
        return $this->redirect(['action' => 'index']);
    }
}
