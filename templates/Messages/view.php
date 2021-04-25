<h1 class="title is-1">Message</h1>

<div class="box">
    <h2 class="title is-2"><?= $message->subject?></h2>
    <p><?= $message->content?></p>
    <?= $this->Html->link('Répondre', ['controller'=>'Messages', 'action' => 'new', $message->sender_id], ['class' => 'button is-link is-light mt-3']) ?>
</div>
