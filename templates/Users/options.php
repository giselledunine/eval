<h1 class="title is-1">Paramètres</h1>

<?= $this->Html->link('Modifier mes informations', ['controller' => 'Users', 'action' => 'update', $user->id], ['class' => 'button is-link is-light']) ?>
<br/>
<?= $this->Form->postLink('Supprimer', ['controller' => 'Users', 'action' => 'delete', $user->id], ['class' => 'button is-danger mt-3'], ['confirm' => 'Etes-vous sûr de vouloir supprimer cette photo ?']) ?>
