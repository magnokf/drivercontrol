<div class="app_sidebar_nav">
    <a class="icon-home radius transition" title="Dashboard" href="<?= url("/app"); ?>">Painel do Motorista</a>
    <a class="icon-user radius transition" title="Perfil" href="<?= url("/app/perfil"); ?>">Meu Perfil</a>
<!--    <a class="icon-car radius transition" title="Meu Carro" href="--><?//= url("/app/cars"); ?><!--">Meus carros</a>-->
<!--    <a class="icon-briefcase radius transition" title="Meu Contrato" href="--><?//= url("/app/contract"); ?><!--">Contrato</a>-->
<!--    <a class="icon-warning radius transition" title="Manutenção/Reparo" href="--><?//= url("/app/carcare"); ?><!--">Manutenção & Reparos</a>-->
    <a class="icon-car radius transition " title="Carteiras | Carros" href="<?= url("/app/carteiras"); ?>">Carteiras | Carros </a>
    <a class="icon-cogs radius transition " title="Manutenções|Carros" href="<?= url("/app/manutencao"); ?>">Manutenções|Carros </a>
    <a class="icon-calendar-check-o radius transition" title="Receber" href="<?= url("/app/receber"); ?>">Receber</a>
    <a class="icon-calendar-minus-o radius transition " title="Pagar" href="<?= url("/app/pagar"); ?>">Pagar</a>
    <a class="icon-exchange radius transition " title="Fixas" href="<?= url("/app/fixas"); ?>">Contas Fixas</a>
    <a class="icon-coffee radius transition" title="Assinatura" href="<?= url("/app/assinatura"); ?>">Assinatura</a>

    <span class="icon-lifebuoy radius transition" data-modalopen=".app_modal_contact">Suporte</span>
    <a class="icon-logout radius transition" title="Sair" href="<?= url("/app/sair"); ?>">Sair</a>
</div>