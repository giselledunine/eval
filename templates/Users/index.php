<?php if($this->request->getAttribute('identity') !== null) : ?>
<h1 class="title is-1">Bienvenue <?= $this->request->getAttribute('identity')->username ?></h1>
    <?php else : ?>
    <h1 class="title is-1">Bienvenue</h1>
<?php endif; ?>

<h3 class="title is-3">Les utilisateurs</h3>
<table class="table table table is-fullwidth is-hoverable">
    <thead>
    <tr>
        <th>Liste des utilisateurs</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <th><?= $this->Html->link($user->username, ['controller'=>'Users', 'action' => 'details', $user->id]) ?></th>
            <th class="has-text-right"><?= $this->Html->link('Envoyer un message', ['controller'=>'Messages', 'action' => 'new', $user->id], ['class' => 'button is-link is-light']) ?></th>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<h3 class="title is-3">Les utilisateurs avec le plus de listes</h3>
<div class="box">
    <table class="table table table is-fullwidth is-hoverable">
        <thead>
        <tr>
            <th>#</th>
            <th>Auteur</th>
            <th>Nombre de listes</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach ($results as $result): $i++;?>
            <tr>
                <th><?= $i?></th>
                <td><?= $result['username']?></td>
                <td><?= $result['number'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<h3 class="title is-3">Les utilisateurs avec le plus grand nombre de tâches réalisées</h3>
<div class="box">
    <table class="table table table is-fullwidth is-hoverable">
        <thead>
        <tr>
            <th>#</th>
            <th>Auteur</th>
            <th>Nombre de tâches réalisées</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach ($checked as $check): $i++;?>
            <tr>
                <th><?= $i ?></th>
                <td><?= $check['username']?></td>
                <td><?= $check['number'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<h3 class="title is-3">Les listes les plus copiées</h3>
<div class="box">
    <table class="table table table is-fullwidth is-hoverable">
        <thead>
        <tr>
            <th>#</th>
            <th>Titre de la liste</th>
            <th>Nombre de copie</th>
            <th>Auteur de la liste</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach ($copies as $copy): $i++;?>
            <tr>
                <th><?= $i ?></th>
                <td><?= $copy['title']?></td>
                <td><?= $copy['number'] ?></td>
                <td><?= $copy['username']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>
