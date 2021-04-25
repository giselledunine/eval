<div class="box">
    <h3 class="title is-3">Créer un compte</h3>
    <?= $this->Form->create($new,['enctype' => 'multipart/form-data']) ?>

    <div id="file-js-example" class="file has-name">
        <label class="file-label">
            <input class="file-input" type="file" name="avatar" id="avatar">
            <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choisissez un avatar
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


    <input type="text" name="username" class="input is-primary mt-3" id="username" placeholder="Nom d'utilisateur">
    <input type="password" name="password" class="input is-primary mt-3 mb-3" id="password" placeholder="Mot de passe">

    <?= $this->Form->button('Créer un compte', ['class' => 'button is-primary mb-3']) ?>


    <?= $this->Form->end() ?>
</div>


