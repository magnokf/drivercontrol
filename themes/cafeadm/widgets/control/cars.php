<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/control/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-flag">Carros</h2>
        <a class="icon-plus-circle btn btn-green" href="<?= url("/admin/control/car"); ?>">Novo Carro</a>
    </header>

    <div class="dash_content_app_box">
        <section>
            <div class="app_control_plans">
                <?php if (!$cars): ?>
                    <div class="message info icon-info">Ainda não existem carros cadastrados.</div>
                <?php else: ?>
                    <?php foreach ($cars as $car): ?>
                        <article class="radius">
                            <div>
                                <h4 class="icon-car"><?= $car->plate; ?></h4>
                                <p><b>Assinantes:</b> <?= str_pad($car->subscribersContract()->count(), 3, 0, 0); ?></p>
                                <p><b>Recorrência:</b> R$ <?= str_price($car->recurrenceContract()); ?></p>
                            </div>

                            <div>
                                <p><b>Ano:</b> <?= str_title($car->year); ?></p>

                                <p><b>Status:</b> <?= ($car->status == "active" ? "Ativo" : "Inativo"); ?></p>
                            </div>

                            <div class="actions">
                                <a class="icon-pencil btn btn-blue" title=""
                                   href="<?= url("/admin/control/car/{$car->id}"); ?>">Atualizar</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?= $paginator; ?>
        </section>
    </div>
</section>
