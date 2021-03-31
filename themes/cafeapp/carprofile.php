<?php $v->layout("_theme"); ?>

<div class="app_formbox app_widget">
    <form class="app_form" action="<?= url("/app/carprofile"); ?>" method="post">
        <input type="hidden" name="update" value="true"/>

        <div class="app_formbox_photo">
            <div class="rounded j_profile_image thumb" style="background-image: url('<?= $photo; ?>')"></div>
            <div><input data-image=".j_profile_image" type="file" class="radius"  name="photocar"/></div>
        </div>

        <div class="label_group">
            <label>
                <span class="field icon-user">Marca:</span>
                <input class="radius" type="text" name="make" required
                       value="<?= $car->make; ?>"/>
            </label>

            <label>
                <span class="field icon-user-plus">Modelo:</span>
                <input class="radius" type="text" name="model" required
                       value="<?= $car->model; ?>"/>
            </label>
        </div>

        <label>
            <span class="field icon-briefcase">Combustível:</span>
            <select name="fuel" required>
                <option value="">Selecione</option>
                <option <?= ($car->fuel == "gasolina" ? "selected" : ""); ?> value="gasolina">&ofcir; Gasolina</option>
                <option <?= ($car->fuel == "etanol" ? "selected" : ""); ?> value="etanol">&ofcir; Etanol</option>
                <option <?= ($car->fuel == "gnv" ? "selected" : ""); ?> value="gnv">&ofcir; GNV</option>
            </select>
        </label>

        <div class="label_group">
            <label>
                <span class="field icon-calendar">Ano:</span>
                <input class="radius mask-date" type="text" maxlength="4" name="year" placeholder="yyyy" required
                       value="<?= ($car->year ? $car->year : null); ?>"/>
            </label>

            <label>
                <span class="field icon-briefcase">Placa:</span>
                <input class="radius mask-plate" type="text" onkeyup="this.value = this.value.toUpperCase();" maxlength="7" name="plate" placeholder="" required
                       value="<?= $car->plate; ?>"/>
            </label>
        </div>
      <div class="label_group">
          <label>
              <span class="field icon-paint-brush">Cor Predominante:</span>
              <input class="radius" type="text" maxlength="10" name="color" value="<?= ($car->color ? $car->color : null); ?>" required>
          </label>
      </div>







        <div class="al-center">
            <div class="app_formbox_actions">
                <button class="btn btn_inline radius transition icon-pencil-square-o">Atualizar</button>
            </div>
        </div>
    </form>
</div>
