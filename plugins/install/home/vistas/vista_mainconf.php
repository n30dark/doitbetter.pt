<?php
$lingua = $dados['lingua'];

?>

<script type="text/javascript">
    $(document).ready(function() {
  // ":not([safari])" is desirable but not necessary selector
  $('input:checkbox').checkbox();
  $('input:radio').checkbox();
});

$(function(){
       $("#to_step_4").click(function(){
           $("#mainconf_install").submit();
       });
    });
</script>


<div class="header">
    <?= $lingua->obter('header_main_conf') ?>
    <div class="buttons">
        <span class="button" id="to_step_2" link="<?= BO_URL::obterHrefInterno('install/home/index/bd/').$lingua->lingua?>"><?= $lingua->obter('previous')?></span>
        <span class="button" id="to_step_4" link="<?= BO_URL::obterHrefInterno('install/home/index/finish/').$lingua->lingua?>"><?= $lingua->obter('next')?></span>
    </div>
</div>


<div class="inner_content">
    <div class="title"><?= $lingua->obter('sitename') ?></div>
    <div class="text">
        <div class="disclaimer">
            <?= $lingua->obter('disclaimer_sitename') ?>
        </div>
        <div class="install">
            <form action="<?= BO_URL::obterHrefInterno('install/home/index/finish/').$lingua->lingua?>" id="mainconf_install" name="mainconf_install" method="post">
            <table>
                <tr>
                    <td>
                        <label for="sitename"><?= $lingua->obter("sitename") ?></label><br />
                        <input type="text" name="sitename" id="sitename" value="">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="title"><?= $lingua->obter('email_password_confirm') ?></div>
    <div class="text">
        <div class="disclaimer">
            <?= $lingua->obter('disclaimer_email_password_confirm') ?>
        </div>
        <div class="install">
            <table>
                <tr>
                    <td>
                        <label for="email"><?= $lingua->obter("youremail") ?></label><br />
                        <input type="text" name="email" id="email" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password"><?= $lingua->obter("adminpass") ?></label><br />
                        <input type="password" name="password" id="password" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="confirm_password"><?= $lingua->obter("confirm_adminpass") ?></label><br />
                        <input type="password" name="confirm_password" id="confirm_password" value="">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="title"><?= $lingua->obter('site_specs') ?></div>
    <div class="text">
        <div class="disclaimer">
            <?= $lingua->obter('disclaimer_site_specs') ?>
        </div>
        <div class="install">
            <table>
                <tr>
                    <td>
                        <label for="register"><?= $lingua->obter("tem_registro") ?></label><br />
                        <input type="checkbox" name="register" id="register" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="ecommerce"><?= $lingua->obter("tem_ecommerce") ?></label><br />
                        <input type="checkbox" name="ecommerce" id="ecommerce" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newsletter"><?= $lingua->obter("tem_newsletter") ?></label><br />
                        <input type="checkbox" name="newsletter" id="newsletter" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="contact"><?= $lingua->obter("tem_contacto") ?></label><br />
                        <input type="checkbox" name="contact" id="contact" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="guestbook"><?= $lingua->obter("tem_guestbook") ?></label><br />
                        <input type="checkbox" name="guestbook" id="guestbook" value="">
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
