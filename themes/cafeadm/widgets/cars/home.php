<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/cars/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-car">Carros</h2>
        <form action="<?= url("/admin/cars/home"); ?>" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Pesquisar Carro:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <div class="dash_content_app_box">
        <section>
            <div class="app_users_home">
                <?php foreach ($cars as $car):
                    $carPhoto = ($car->photocar() ? image($car->photocar, 300, 300) :
                        theme("/assets/images/car_avatar.jpg", CONF_VIEW_ADMIN));
                    ?>
                    <article class="user radius">
                        <div class="cover" style="background-image: url(<?= $carPhoto; ?>)"></div>
                        <?php if ($car->contract_id == null): ?>
                            <p class="level icon-life-ring">EM CONTRATO</p>
                        <?php else: ?>
                            <p class="level icon-user">DISPONÍVEL</p>
                        <?php endif; ?>

                        <h4><?= $car->plate; ?></h4>
                        <div class="info">

                            <p>Desde <?= date_fmt($car->created_at, "d/m/y \à\s H\hi"); ?></p>
                        </div>

                        <div class="actions">
                            <a class="icon-cog btn btn-blue" href="<?= url("/admin/cars/car/{$car->id}"); ?>"
                               title="">Gerenciar</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?= $paginator; ?>
        </section>
    </div>
</section>