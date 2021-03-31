<?php $v->layout("_theme"); ?>

<div class="ajax_response"></div>

<section class="app_wallets">
    <article class="wallet wallet_add radius gradient-blue">
        <h2 class="icon-info icon-notext"></h2>
        <h3>Crie e gerencie seus carros</h3>
        <p>Organize seus carros.</p>
        <span class="btn wallet_action radius transition icon-plus-circle">Adicionar Carro</span>

        <div class="wallet_overlay radius" style="background-color: var(--color-blue)">
            <div>
                <p>Insira o nome do seu novo carro, como <b>Hb20S Branco</b>, <b>Yaris Preto</b>, <b>KXM9075</b>...
                    e tudo pronto!</p>
                <form action="<?= url("/app/cars/new"); ?>" method="post" autocomplete="off">
                    <input type="text" name="wallet_name" placeholder="Ex: HB20S, Yaris, KXM9075" required/>
                    <button class="form_btn icon-check gradient radius transition gradient-blue gradient-hover">Criar
                        Carro
                    </button>
                </form>
                <span class="wallet_overlay_close icon-sign-out transition">fechar</span>
            </div>
        </div>

    </article>


</section>

