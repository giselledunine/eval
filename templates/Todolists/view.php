<h1 class="title is-1">Mes listes</h1>

<?php foreach ($user->todolists as $list) : ?>

    <div class="box">
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <?php if($list->picture) : ?>
                        <?= $this->Html->image('data/pictures/'.$list->picture, ['alt' => $list->picture]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('data/pictures/defaultavatar.jpg', ['alt' => 'defaultavatar']) ?>
                    <?php endif ?>
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                    <strong><?= $this->Html->link($list->title, ['controller'=>'Todolists', 'action' => 'details', $list->id]) ?></strong>
                        <?php if($list->visibility) : ?>
                            <em>Privé</em>
                        <?php else : ?>
                            <em>Public</em>
                        <?php endif ?>
                    </p>
                    <?= $this->Html->link('Modifier', ['controller' => 'Todolists', 'action' => 'update', $list->id], ['class' => 'button is-link']) ?>
                    <?= $this->Form->postLink('Supprimer', ['controller' => 'Todolists', 'action' => 'delete', $list->id], ['class' => 'button is-danger is-light'], ['confirm' => 'Etes-vous sûr de vouloir supprimer cette liste ?']) ?>
                </div>
            </div>
        </article>
    </div>
        <br/>
<?php endforeach ?>
