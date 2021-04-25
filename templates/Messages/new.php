<h1 class="title is-1">Nouveau message</h1>

<div class="box">
    <?= $this->Form->create($new) ?>

    <?= $this->Form->hidden('sender_id', ['value' => $this->request->getAttribute('identity')->id]) ?>
    <label class="label" for="subject">Sujet
        <input type="text" name="subject" class="input mt-3" placeholder="Sujet" id="subject" maxlength="75">
    </label>
    <label class="label" for="content"> Message
        <textarea name="content" id="content" class="textarea mt-3" placeholder="Tapez votre message ..." rows="5"></textarea>
    </label>
    <?= $this->Form->button('Envoyer', ['class' => 'button is-link mt-3 mb-3']) ?>


    <?= $this->Form->end() ?>
</div>



