<h1 class="title is-1">Mes messages</h1>

<h4 class="title is-4">Messages lu</h4>

<?php foreach ($messages as $message): ?>

<?php if (!empty($message->read_at)): ?>

    <div class="box">
        <article class="media">
            <div class="media-content">
                <div class="content">
                    <p>
                        <?= $this->Form->postlink($message->subject, ['controller' => 'Messages', 'action' => 'readAt', $message->id], ['class' => 'has-text-weight-semibold']) ?> -
                        <?php foreach ($users as $user): ?>
                            <?php if($user->id === $message->sender_id) : ?>
                                <small><?= $user->username?></small> -
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <small><?= $message->created?></small>
                    </p>
                            <?= $this->Html->link('Répondre', ['controller'=>'Messages', 'action' => 'new', $message->sender_id], ['class' => 'button is-link is-light']) ?>
                </div>
            </div>
        </article>
    </div>
    <?php endif ; ?>
    <?php endforeach; ?>

    <h4 class="title is-4">Messages non-lu</h4>
    <?php foreach ($messages as $message): ?>
<?php if (empty($message->read_at)): ?>

    <div class="box">
        <article class="media">
            <div class="media-content">
                <div class="content">
                    <p>
                        <?= $this->Form->postlink($message->subject, ['controller' => 'Messages', 'action' => 'readAt', $message->id], ['class' => 'has-text-weight-semibold']) ?> -
                        <?php foreach ($users as $user): ?>
                            <?php if($user->id === $message->sender_id) : ?>
                                <small><?= $user->username?></small> -
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <small><?= $message->created?></small>
                    </p>
                    <?php foreach ($users as $user): ?>
                        <?php if($user->id === $message->sender_id) : ?>
                            <?= $this->Html->link('Répondre', ['controller'=>'Messages', 'action' => 'new', $user->id], ['class' => 'button is-link is-light']) ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </article>
    </div>
    <?php endif ; ?>
<?php endforeach; ?>

