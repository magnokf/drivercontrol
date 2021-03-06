<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <meta name="mit" content="2020-01-28T06:39:41-03:00+170220">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#F67D33">

    <?= $head; ?>

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<!--HEADER-->
<header class="main_header gradient gradient-blue">
    <div class="container">
        <div class="main_header_logo">
            <h1><a class="icon-car transition" title="Home" href="<?= url(); ?>">Driver<b>Control</b></a></h1>
        </div>

        <nav class="main_header_nav">
            <span class="main_header_nav_mobile j_menu_mobile_open icon-menu icon-notext radius transition"></span>
            <div class="main_header_nav_links j_menu_mobile_tab">
                <span class="main_header_nav_mobile_close j_menu_mobile_close icon-error icon-notext transition"></span>
                <a class="link transition radius" title="Home" href="<?= url(); ?>">Home</a>
                <a class="link transition radius" title="Sobre" href="<?= url("/sobre"); ?>">Sobre</a>
                <!---<a class="link transition radius" title="Blog" href="<?= url("/blog"); ?>">Blog</a>-->

                <?php if (\Source\Models\Auth::user()): ?>
                    <a class="link login transition radius icon-coffee" title="Controlar"
                       href="<?= url("/app"); ?>">Controlar</a>
                <?php else: ?>
                    <a class="link login transition radius icon-sign-in" title="Entrar"
                       href="<?= url("/entrar"); ?>">Entrar</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

<!--CONTENT-->
<main class="main_content">
    <?= $v->section("content"); ?>
</main>

<?php if ($v->section("optout")): ?>
    <?= $v->section("optout"); ?>
<?php else: ?>
    <article class="footer_optout">
        <div class="footer_optout_content content">
            <span class="icon icon-coffee icon-notext"> </span><span class="icon icon-car icon-notext"></span>
            <h2>Motoristas de Aplicativo.</h2>
            <h3>Comece a controlar suas contas agora mesmo.</h3>
            <p>?? r??pido, simples e gratuito!</p>
            <a href="<?= url("/cadastrar"); ?>"
               class="footer_optout_btn gradient gradient-green gradient-hover radius icon-check-square-o">Quero
                controlar</a>
        </div>
    </article>
<?php endif; ?>

<!--FOOTER-->
<footer class="main_footer">
    <div class="container content">
        <section class="main_footer_content">
            <article class="main_footer_content_item">
                <h2>Sobre:</h2>
                <p>O DriverControl ?? um gerenciador de contas simples, poderoso e gratuito. O prazer de tomar um caf?? e
                    ter o controle total de suas contas.</p>
                <a title="Termos de uso" href="<?= url("/termos"); ?>">Termos de uso</a>
            </article>

            <article class="main_footer_content_item">
                <h2>Mais:</h2>
                <a class="link transition radius" title="Home" href="<?= url(); ?>">Home</a>
                <a class="link transition radius" title="Sobre" href="<?= url("/sobre"); ?>">Sobre</a>
                <!--<a class="link transition radius" title="Blog" href="<?= url("/blog"); ?>">Blog</a>-->
                <a class="link transition radius" title="Entrar" href="<?= url("/entrar"); ?>">Entrar</a>
            </article>

            <article class="main_footer_content_item">
                <h2>Contato:</h2>
                <p class="icon-phone"><b>Telefone:</b><br><mobile>+55 21 98243.6914</mobile> </p>
                <p class="icon-envelope"><b>Email:</b><br> <e-mail>drivercontrol@dmrtech.com.br</e-mail> </p>
                <p class="icon-map-marker"><b>Endere??o:</b><br><address>Rio de Janeiro, RJ/Brasil</address> </p>
            </article>

            <article class="main_footer_content_item social">
                <h2>Social:</h2>
                <a target="_blank" class="icon-facebook"
                   href="https://www.facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE; ?>" title="DriverControl no Facebook">/DriverControl</a>
                <a target="_blank" class="icon-instagram"
                   href="https://www.instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>" title="DriverControl no Instagram">@DriverControl</a>
                <a target="_blank" class="icon-youtube" href="https://www.youtube.com/<?= CONF_SOCIAL_YOUTUBE_PAGE; ?>"
                   title="DriverControl no YouTube">/DriverControl</a>
            </article>
        </section>
    </div>
</footer>

<script async src="https://www.googletagmanager.com/gtag/js?id="></script>
<script src="<?= theme("/assets/scripts.js"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>
</html>