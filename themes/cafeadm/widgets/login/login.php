<?php $v->layout("_login"); ?>

<div class="login">
    <article class="login_box radius">
        <h1 class="hl icon-coffee">Login <span class="icon icon-car"></span></h1>
        <div class="ajax_response"><?= flash(); ?></div>

        <form name="login" action="<?= url("/admin/login"); ?>" method="post">
            <label>
                <span class="field icon-envelope">E-mail:</span>
                <input name="email" type="email" placeholder="Informe seu e-mail" required/>
            </label>

            <label>
                <span class="field icon-unlock-alt">Senha:</span>
                <input name="password" type="password" placeholder="Informe sua senha:" required/>
            </label>

            <button class="radius gradient gradient-green gradient-hover icon-sign-in">Entrar</button>
        </form>

        <footer>
            <p>Atualizado por www.<b>dmrtech.com.br</b>.com</p>
            <p>&copy; <?= date("Y"); ?> - todos os direitos reservados</p>
            <a target="_blank"
               class="icon-whatsapp transition"
               href="https://api.whatsapp.com/send?phone=5521982436914&text=Olá, preciso de ajuda com o login."
            >WhatsApp: (21) 98243 6914</a>
            <a target="_blank"

               href="<?php echo CONF_URL_BASE ?>/recuperar"
            >Recuperar senha</a>
        </footer>
    </article>
</div>