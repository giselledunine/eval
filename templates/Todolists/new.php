<h1 class="title is-1">Créer une liste</h1>

<div class="box">
    <?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>

    <div id="file-js-example" class="file has-name">
        <label class="file-label">
            <input class="file-input" type="file" name="picture" id="picture">
            <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choisissez une image
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

    <div class="control has-icons-left has-icons-right mt-3 mb-3">
        <input class="input" type="text" placeholder="Titre" name="title" id="title" >
        <span class="icon is-small is-left">
    <i class="fas fa-envelope"></i>
  </span>
        <span class="icon is-small is-right">
    <i class="fas fa-check"></i>
  </span>
    </div>

    <label for="visibility">
        <input type="checkbox" name="visibility" value="1" class="checkbox" id="visibility">
        Privé
    </label>

    <br/>
    <?= $this->Form->button('Créer une liste', ['class' => 'button is-link mt-3']) ?>


    <?= $this->Form->end() ?>
</div>
