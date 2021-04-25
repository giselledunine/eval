<h1 class="title is-1">Modifier la liste</h1>

<div class="box">
    <?= $this->Form->create($update, ['enctype' => 'multipart/form-data']) ?>

    <div id="file-js-example" class="file has-name mb-3">
        <label class="file-label">
            <input class="file-input" type="file" name="picture" id="picture">
            <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choisissez une nouvelle image
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
    <input type="text" class="input mb-3" name="title" id="title" maxlength="50">
    <label for="visibility">
        <input type="checkbox" name="visibility" value="1" class="checkbox mb-3" id="visibility">
        Privé
    </label>
    <br/>
    <?= $this->Form->button('Modifier la liste', ['class' => 'button is-link']) ?>


    <?= $this->Form->end() ?>
</div>
