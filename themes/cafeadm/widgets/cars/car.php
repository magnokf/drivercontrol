<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/cars/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$car): ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Novo Carro</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/cars/car"); ?>" method="post" enctype="multipart/form-data">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create"/>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Marca:</span>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="make" placeholder="Ex. Hyundai" required/>
                    </label>

                    <label class="label">
                        <span class="legend">*Modelo:</span>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="model" placeholder="Ex. HB20S" required/>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Combustivel:</span>
                    <select name="fuel">
                        <option value="gasolina">Gasolina</option>
                        <option value="flex">Flex</option>
                        <option value="gnv">GNV</option>
                        <option value="diesel">Diesel</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Foto: (600x600px)</span>
                    <input type="file" name="photocar"/>
                </label>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Ano:</span>
                        <input type="text" class="mask-year" name="year" placeholder="yyyy"/>
                    </label>

                    <label class="label">
                        <span class="legend">*Placa:</span>
                        <input class="mask-plate" type="text" onkeyup="this.value = this.value.toUpperCase();" name="plate" placeholder="Ex. KXX9117" maxlength="7"/>
                    </label>
                </div>
                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Cor:</span>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="color" required/>
                    </label>

                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="status" required>
                            <option value="active">Ativo</option>
                            <option value="inactive">Desativado</option>
                        </select>
                    </label>
                </div>

                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Criar Carro</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <header class="dash_content_app_header">
            <h2 class="icon-car"><?= $car->plate; ?></h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/cars/car/{$car->id}"); ?>" method="post" enctype="multipart/form-data">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update"/>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Marca:</span>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="make" value="<?= $car->make; ?>" required/>
                    </label>

                    <label class="label">
                        <span class="legend">*Modelo:</span>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="model" value="<?= $car->model; ?>" required/>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">*Combustível:</span>
                    <select name="fuel">
                        <?php
                        $fuel = $car->fuel;
                        $select = function ($value) use ($fuel) {
                            return ($fuel == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $select("gasolina"); ?> value="gasolina">Gasolina</option>
                        <option <?= $select("flex"); ?> value="flex">Flex</option>
                        <option <?= $select("gnv"); ?> value="gnv">Gnv</option>
                        <option <?= $select("diesel"); ?> value="diesel">Diesel</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Foto do Carro: (600x600px)</span>
                    <input type="file" name="photocar"/>
                </label>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Ano:</span>
                        <input type="text" class="mask-year" value="<?= ($car->year ? $car->year: null) ; ?>"
                               name="year" placeholder="yyyy" maxlength="4"/>
                    </label>

                    <label class="label">
                        <span class="legend">*Placa do Carro:</span>
                        <input class="mask-plate" type="text" name="plate" onkeyup="this.value = this.value.toUpperCase();" value="<?= $car->plate; ?>" maxlength="7"/>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Cor:</span>
                        <input type="text" name="color" onkeyup="this.value = this.value.toUpperCase();" value="<?= ($car->color ? $car->color: null) ; ?>"/>

                    </label>

                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="status" required>
                            <?php
                            $status = $car->status;
                            $select = function ($value) use ($status) {
                                return ($status == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select("active"); ?> value="active">Ativado</option>
                            <option <?= $select("inactive"); ?> value="inactive">Desativado</option>
                        </select>
                    </label>
                </div>

                <div class="app_form_footer">
                    <button class="btn btn-blue icon-check-square-o">Atualizar</button>
                    <a href="#" class="remove_link icon-warning"
                       data-post="<?= url("/admin/cars/car/{$car->id}"); ?>"
                       data-action="delete"
                       data-confirm="ATENÇÃO: Tem certeza que deseja excluir o carro e todos os dados relacionados a ele? Essa ação não pode ser desfeita!"
                       data-car_id="<?= $car->id; ?>">Excluir Carro</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</section>
