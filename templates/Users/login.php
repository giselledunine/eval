<?= $this->Html->css(['bulma/bulma.min']) ?>

<div class="box">
    <h3 class="title is-3">Connexion</h3>
    <?= $this->Form->create() ?>

    <input type="text" name="username" class="input is-primary mt-3" id="username" placeholder="Nom d'utilisateur">
    <input type="password" name="password" class="input is-primary mt-3 mb-3" id="password" placeholder="Mot de passe">

    <?= $this->Form->button('Se connecter', ['class' => 'button is-primary mb-3']) ?>


    <?= $this->Form->end() ?>

    <?= $this->Html->link('Ajouter un utilisateur', ['controller'=>'Users', 'action' => 'new'], ['class' => 'button is-primary is-light mt-3 mb-3']) ?>
</div>
