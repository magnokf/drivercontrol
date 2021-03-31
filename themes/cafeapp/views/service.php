<div class="app_modal_box app_modal_<?= $type; ?>">
    <p class="title icon-calendar-check-o">Registrar <?= ($type == 'oleo' ? "Troca de Óleo" : "Serviço | Reparo"); ?>:</p>
    <form class="app_form" action="<?= url("/app/launch"); ?>" method="post">
        <input type="hidden" name="currency" value="BRL"/>
        <input type="hidden" name="type" value="<?= $type; ?>"/>

        <label>
            <span class="field icon-leanpub">Odometro:</span>
            <input class="radius" type="number" name="odo_km" placeholder="EX. 050000" max="999999" maxlength="6" required/>
        </label>

        <label>
            <span class="field icon-leanpub">Descrição:</span>
            <input class="radius" type="text" name="description" placeholder="Troca de Lâmpada, Troca de Óleo" maxlength="40" required/>
        </label>

        <div class="label_group">
            <label>
                <span class="field icon-money">Valor:</span>
                <input class="radius mask-money" type="text" name="value" required/>
            </label>

            <label>
                <span class="field icon-filter">Data:</span>
                <input class="radius masc-date" type="date" name="due_at" required/>
            </label>
        </div>

        <div class="label_group">
            <label>
                <span class="field icon-car">Carteira | Carro:</span>
                <select name="wallet_id">
                    <?php foreach ($wallets as $wallet): ?>
                        <option value="<?= $wallet->id; ?>">&ofcir; <?= $wallet->wallet ?></option>
                    <?php endforeach; ?>
                </select>
            </label>


        </div>
        <button class="btn radius transition icon-check-square-o">
            Lançar <?= ($type == 'oleo' ? "Troca de Óleo" : "Serviço | Reparo"); ?></button>
    </form>
</div>
