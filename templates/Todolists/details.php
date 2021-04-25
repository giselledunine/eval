
<div class="columns is-gapless is-multiline">
    <div>
        <figure class="image is-64x64">
            <?= $this->Html->image('data/pictures/'.$list->picture)?>
        </figure>
    </div>
    <div class="column is-two-quarter">
        <h1 class="title is-1 ml-3"><?= $list->title?></h1>
    </div>
</div>

    <table class="table table table is-fullwidth is-hoverable">
        <tbody>
        <?php foreach ($list->items as $item):?>
            <tr>
                <?php if ($item->status === true) : ?>

                    <td class="has-text-left">
                        <?= $this->Form->create($editItem, ['url'=>['controller' => 'Items', 'action' => 'edit', $item->id, $list->id]]) ?>
                        <?= $this->Form->hidden('status', ['value' => false]) ?>
                        <button class="button is-link is-outlined" type="submit"><?= $this->Html->image('data/pictures/check-box.svg',array('height' => '20', 'width' => '20'))?></button>
                        <?= $this->Form->end() ?>
                    </td>

                <?php else : ?>

                    <td class="has-text-left">
                        <?= $this->Form->create($editItem, ['url'=>['controller' => 'Items', 'action' => 'edit', $item->id, $list->id]]) ?>
                        <?= $this->Form->hidden('status', ['value' => true]) ?>
                        <button class="button is-link" type="submit"><?= $this->Html->image('data/pictures/whitecheckbox.svg',array('height' => '20', 'width' => '20'))?></button>
                        <?= $this->Form->end() ?>
                    </td>

                <?php endif ?>

                <td><p class="is-size-4"><?= $item->content?></p></td>
                <td class="is-vcentered"><p class="is-size-6"><?= $item->deadline?></p></td>

                <?php if ($list->user_id === $this->request->getAttribute('identity')->id) : ?>
                <td class="has-text-right">
                    <?= $this->Html->link('Suprrimer', ['controller' => 'Items', 'action' => 'delete', $item->id, $list->id], ['class' => 'button is-danger is-light']) ?>
                </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>

    <br/>

<h4 class="title is-4">Ajouter des tâches</h4>
<div class="tache">
    <?= $this->Form->create($newItem, ['url'=>['controller' => 'Items', 'action' => 'new', $list->id], 'class' => 'box']) ?>

    <?= $this->Form->hidden('list_id', ['value' => $list->id]) ?>
    <?= $this->Form->hidden('status', ['value' => false]) ?>
    <input type="text" name="content" class="input mb-3" placeholder="La tâche" class="input text" id="content" maxlength="250">
    <input type="date" name="deadline" class="input date mb-3" id="deadline" value="">
    <?= $this->Form->button('Ajouter la tâche', ['class' => 'button is-link']) ?>


    <?= $this->Form->end() ?>
</div>
