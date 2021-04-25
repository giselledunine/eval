<h1 class="title is-1">Modifier mon compte</h1>

<div class="box">
    <?= $this->Form->create($update,  ['enctype' => 'multipart/form-data']) ?>

    <div id="file-js-example" class="file has-name mb-3">
        <label class="file-label">
            <input class="file-input" type="file" name="avatar" id="avatar">
            <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choisissez un nouvel avatar
      </span>
    </span>
            <span class="file-name">
      Pas de fichier séléctionné
    </span>
        </label>
    </div>

    <script>
        const fileInput = document.querySelector('#file-js-example input[type=file]');
        fileInput.onchange = () => {
            if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file-js-example .file-name');
                fileName.textContent = fileInput.files[0].name;
            }
        }
    </script>
    <input type="text" name="username" class="input mb-3" required="required" data-validity-message="This field cannot be left empty" oninvalid="this.setCustomValidity(''); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity('')" id="username" maxlength="30">
    <input type="password" class="input mb-3" name="newpassword" id="newpassword" placeholder="Votre nouveau mot de passe ...">
    <?= $this->Form->button('Modifier mon compte', ['class' => 'button is-link']) ?>


    <?= $this->Form->end() ?>
</div>

