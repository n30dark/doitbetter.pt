<?php
$lingua = $dados['lingua'];

?>
<script type="text/javascript">
    $(function(){
       $("#to_step_4").click(function(){
           $("#bd_install").submit();
       });
    });
</script>

<div class="header">
    <?= $lingua->obter('header_bd') ?>
    <div class="buttons">
        <span class="button" id="to_step_2" link="<?= BO_URL::obterHrefInterno('install/home/index/license/').$lingua->lingua?>"><?= $lingua->obter('previous')?></span>
        <span class="button" id="to_step_4" link=""><?= $lingua->obter('next')?></span>
    </div>
</div>


<div class="inner_content">
    <div class="title"><?= $lingua->obter('connection_config') ?></div>
    <div class="text">
        <div class="disclaimer">
            <?= $lingua->obter('disclaimer_connection_config') ?>
        </div>
    </div>

    <div class="title"><?= $lingua->obter('bd_config') ?></div>
    <div class="text">
        <div class="disclaimer">
            <?= $lingua->obter('disclaimer_bd_config') ?>
        </div>
    
        <div class="install">
            <h3><?= $lingua->obter('bd_config') ?></h3>
            <form action="<?= BO_URL::obterHrefInterno('install/home/index/mainconf/').$lingua->lingua?>" id="bd_install" name="bd_install" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="bd_type"><?= $lingua->obter("bd_type") ?></label><br />
                            <select name="bd_type" id="bd_type">
                                <option selected value="mysql">mysql</option>
                                <option selected value="mysqli">mysqli</option>
                            </select>
                        </td>
                        <td>
                            <span class="help"><?= $lingua->obter('bd_type_help') ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="server_name"><?= $lingua->obter('server_name') ?></label><br />
                            <input type="text" name="server_name" id="server_name" value="localhost">
                        </td>
                        <td>
                            <span class="help"><?= $lingua->obter('server_name_help') ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="bd_username"><?= $lingua->obter('bd_username') ?></label><br />
                            <input type="text" name="bd_username" id="bd_username">
                        </td>
                        <td>
                            <span class="help"><?= $lingua->obter('bd_username_help') ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="bd_password"><?= $lingua->obter('bd_password') ?></label><br />
                            <input type="password" name="bd_password" id="bd_password">
                        </td>
                        <td>
                            <span class="help"><?= $lingua->obter('bd_password_help') ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="bd_name"><?= $lingua->obter('bd_name') ?></label><br />
                            <input type="text" name="bd_name" id="bd_name">
                        </td>
                        <td>
                            <span class="help"><?= $lingua->obter('bd_name_help') ?></span>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
