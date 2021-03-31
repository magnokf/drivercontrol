<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/control/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$car): ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Novo Carro</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/control/car"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create"/>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Marca:</span>
                        <input type="text" name="make" placeholder="" required/>
                    </label>

                    <label class="label">
                        <span class="legend">*Modelo:</span>
                        <input type="text" name="model" required/>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Ano:</span>
                        <select name="year" required>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">*Combustível:</span>
                        <select name="fuel" required>
                            <option value="gasolina">Gasolina</option>
                            <option value="etanol">Etanol</option>
                            <option value="gnv">GNV</option>
                        </select>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <option value="active">Ativo</option>
                        <option value="inactive">Inativo</option>
                    </select>
                </label>

                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Criar Carro</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <header class="dash_content_app_header">
            <h2 class="icon-pencil-square-o">Editar Carro</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/control/car/{$car->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update"/>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Marca:</span>
                        <input type="text" name="name" value="<?= $car->make; ?>" required/>
                    </label>

                    <label class="label">
                        <span class="legend">*Modelo:</span>
                        <input type="text" name="model"
                               value="<?= str_slug($car->model); ?>" required/>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Ano:</span>
                        <select name="period" required>
                            <?php
                            $ano = $car->year;
                            $selected = function ($value) use ($ano) {
                                return ($ano == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $selected("2017"); ?> value="2017">2017</option>
                            <option <?= $selected("2018"); ?> value="2018">2018</option>
                            <option <?= $selected("2019"); ?> value="2019">2019</option>
                            <option <?= $selected("2020"); ?> value="2020">2020</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="period_str" required>
                            <?php
                            $status = $car->status;
                            $selected = function ($value) use ($status) {
                                return ($status == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $selected("active"); ?> value="ativo">Ativo</option>
                            <option <?= $selected("inactive"); ?> value="ano">Ano</option>
                        </select>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <?php
                        $status = $plan->status;
                        $selected = function ($value) use ($status) {
                            return ($status == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $selected("active"); ?> value="active">Ativo</option>
                        <option <?= $selected("inactive"); ?> value="inactive">Inativo</option>
                    </select>
                </label>

                <div class="app_form_footer">
                    <button class="btn btn-blue icon-check-square-o">Atualizar</button>
                    <?php if (!$subscribers): ?>
                        <a href="#" class="remove_link icon-error"
                           data-post="<?= url("/admin/control/car"); ?>"
                           data-action="delete"
                           data-confirm="Tem certeza que deseja excluir este Carro?"
                           data-plan_id="<?= $car->id; ?>">Excluir Carro</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    <?php endif; ?>
</section>
