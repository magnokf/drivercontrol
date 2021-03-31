<form action="<?= $action; ?>" method="post" class="app_form" name="formPagamento" id="formPagamento">
    <input type="hidden" name="receiverEmail" id="receiverEmail" value="<?php echo EMAIL_LOJA; ?>">

    <input type="hidden" name="currency" id="currency" value="<?php echo MOEDA_PAGAMENTO; ?>">
    <input type="hidden" name="notificationURL" id="notificationURL" value="<?php echo URL_NOTIFICACAO; ?>">

    <?php if ($plans): ?>
        <div class="label_check al-center">
            <?php
            $checked = 0;
            foreach ($plans as $plan):
                $checked++;
                ?>
                <label class="<?= ($checked == 1 ? "check" : ""); ?>" data-checkbox="true">
                    <input type="radio" name="plan"
                           value="<?= $plan->id; ?>" <?= ($checked == 1 ? "checked" : ""); ?> >
                    <?= $plan->name; ?> R$ <?= str_price($plan->price); ?>/<?= $plan->period_str; ?>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <label>
        <span class="field">Número do cartão:</span>
        <input type="hidden" name="PaymentMethod" id="PaymentMethod" value="CreditCard">
        <input class="radius mask-card" name="numCartao" id="numCartao" type="tel" required
               placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;"/>
    </label>
    <span class="field">CPF do Titular do Cartão</span>
    <input type="text"  class="mask-doc" name="creditCardHolderCPF" id="creditCardHolderCPF" placeholder="CPF sem traço" value="22111944785" required><br><br>

    <label>
        <span class="field">Nome do títular:</span>
        <input class="radius" name="card_holder_name" type="text" required
               placeholder="Igual ao impresso no cartão"/>
    </label>

    <div class="label_group">
        <label>
            <span class="field">Data de expiração:</span>
            <input class="radius mask-month" name="card_expiration_date" type="text" required
                   placeholder="mm/yyyy"/>
        </label>

        <label>
            <span class="field">CVV:</span>
            <input class="radius" name="cvvCartao" id="cvvCartao" type="number" required
                   placeholder="&bull;&bull;&bull;"/>
        </label>
    </div>

    <button class="btn radius transition icon-check-square-o"><?= ($btn ?? "Confirmar Pagamento"); ?></button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
<script src="js/personalizado.js"></script>