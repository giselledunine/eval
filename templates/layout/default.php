<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['bulma/bulma.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="navbar is-vcentered" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
            <?= $this->Html->link('ToDoLists', ['controller'=>'Users', 'action' => 'index'], ['class' => 'title is-4 navbar-item mb-0']) ?>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>


    <div id="navbarBasicExample" class="navbar-menu">

        <?php if($this->request->getAttribute('identity') !== null) : ?>
        <div class="navbar-start">

                <div class="navbar-item has-dropdown is-hoverable">
                <?= $this->Html->link('Mes listes', ['controller'=>'Todolists', 'action' => 'view', $this->request->getAttribute('identity')->id], ['class' => 'navbar-link']) ?>

                <div class="navbar-dropdown">
                    <?= $this->Html->link('Créer une liste', ['controller'=>'Todolists', 'action' => 'new'], ['class' => 'navbar-item']) ?>
                </div>
                </div>
                <?= $this->Html->link('Mes messages', ['controller'=>'Messages', 'action' => 'index'], ['class' => 'navbar-item']) ?>

        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="navbar-item has-dropdown is-hoverable">
                    <?= $this->Html->link($this->request->getAttribute('identity')->username, ['controller'=>'Users', 'action' => 'options', $this->request->getAttribute('identity')->id], ['class' => 'button is-primary is-outlined']) ?>
                    <div class="navbar-dropdown is-right">
                        <?=  $this->Html->link('Modifier son compte', ['controller'=>'Users', 'action' => 'options', $this->request->getAttribute('identity')->id], ['class' => 'navbar-item has-text-info']) ?>
                        <?=  $this->Html->link('Se déconnecter', ['controller'=>'Users', 'action' => 'logout'], ['class' => 'navbar-item has-text-danger']) ?>
                    </div>
                </div>
            </div>
            <?php if(!empty($this->request->getAttribute('identity')->avatar)) : ?>
                <figure class="image is-48x48 mt-2 mb-2 mr-3">
                    <?= $this->Html->image('data/pictures/'.$this->request->getAttribute('identity')->avatar, ['class' => 'is-rounded']) ?>
                </figure>
            <?php else : ?>
                <figure class="image is-48x48 mt-2 mb-2 mr-3">
                    <?= $this->Html->image('data/pictures/defaultavatar.jpg', ['class' => 'is-rounded']) ?>
                </figure>
            <?php endif ; ?>
        </div>

        <?php else: ?>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <?=  $this->Html->link('Créer un compte', ['controller'=>'Users', 'action' => 'new'], ['class' => 'button is-primary']) ?>
                    <?=  $this->Html->link('Se connecter', ['controller'=>'Users', 'action' => 'login'], ['class' => 'button is-primary is-outlined']) ?>
                </div>
            </div>
        </div>

        <?php endif; ?>

    </div>
</nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
