<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/carros</h3>
    <p class="dash_content_sidebar_desc">Gerencie, monitore e acompanhe os veículos do seu site aqui...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("car", "cars/home", "Carros");
        echo $nav("plus-circle", "cars/car", "Novo Carro");
        ?>

        <?php if (!empty($car) && $car->photocar()): ?>
            <img class="radius" style="width: 100%; margin-top: 30px" src="<?= image($car->photocar, 600, 600); ?>"/>
        <?php endif; ?>
    </nav>
</div>