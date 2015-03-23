<?php
    $lingua = $dados['lingua'];
    $checks = $dados['checks'];
    $recomended = $dados['recomended'];
?>
<div class="header">
    <?= $lingua->obter("header_preinstall"); ?>
    <div class="buttons">
        <span class="button" id="check_again" link="<?= BO_URL::obterHrefInterno('install/home/index/preinstall/').$lingua->lingua?>"><?= $lingua->obter("check_again"); ?></span>
        <span class="button" id="to_step_1" link="<?= BO_URL::obterHrefInterno('install/home/index/idioma/').$lingua->lingua?>"><?= $lingua->obter("previous") ?></span>
        <span class="button" id="to_step_3" link="<?= BO_URL::obterHrefInterno('install/home/index/license/').$lingua->lingua?>"><?= $lingua->obter("next") ?></span>
    </div>
</div>


<div class="inner_content">
    <div class="title"><?= $lingua->obter("preinstall_check"); ?></div>
    <div class="text">
        <div class="disclaimer"><?= $lingua->obter("preinstall_check_disclaimer"); ?></div>
        <div class="install">
            <table style="color: #FEFFFF;width:60%;">
                <tr>
                    <td><?= $lingua->obter("php_version");?></td>
                    <td><?= $checks[0] ?></td>
                </tr>
                <tr>
                    <td><?= $lingua->obter("allow_zlib");?></td>
                    <td><?= ($checks[1])?"<span class='chk'>".$lingua->obter("yes_op")."</span>":"<span class='err'>".$lingua->obter("no_op")."</span>"; ?></td>
                </tr>
                <tr>
                    <td><?= $lingua->obter("allow_xml");?></td>
                    <td><?= ($checks[2])?"<span class='chk'>".$lingua->obter("yes_op")."</span>":"<span class='err'>".$lingua->obter("no_op")."</span>"; ?></td>
                </tr>
                <tr>
                    <td><?= $lingua->obter("allow_mysql");?></td>
                    <td><?= ($checks[3])?"<span class='chk'>".$lingua->obter("yes_op")."</span>":"<span class='err'>".$lingua->obter("no_op")."</span>"; ?></td>
                </tr>
                <tr>
                    <td><?= $lingua->obter("editable_configini");?></td>
                    <td><?= ($checks[4])?"<span class='chk'>".$lingua->obter("yes_op")."</span>":"<span class='err'>".$lingua->obter("no_op")."</span>"; ?></td>
                </tr>
           </table>
        </div>
    </div>
    <br />
    <div class="title"><?= $lingua->obter("recomended_config"); ?></div>
    <div class="text">
        <div class="disclaimer"><?= $lingua->obter("recomended_config_disclaimer"); ?></div>
        <div class="install">
            <table style="color: #FEFFFF;width:85%;">
                <thead>
                        <td><?= $lingua->obter('directive')?></td>
                        <td><?= $lingua->obter('recomended')?></td>
                        <td><?= $lingua->obter('status')?></td>
                    </thead>
                    <tr>
                        <td><?= $lingua->obter("safe_mode");?></td>
                        <td><?= $lingua->obter("off_op");?></td>
                        <td><?= ($recomended[0])?"<span class='err'>".$lingua->obter("on_op")."</span>":"<span class='chk'>".$lingua->obter("off_op")."</span>"; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lingua->obter("error_display");?></td>
                        <td><?= $lingua->obter("off_op");?></td>
                        <td><?= ($recomended[1])?"<span class='err'>".$lingua->obter("on_op")."</span>":"<span class='chk'>".$lingua->obter("off_op")."</span>"; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lingua->obter("file_send");?></td>
                        <td><?= $lingua->obter("on_op");?></td>
                        <td><?= ($recomended[2])?"<span class='chk'>".$lingua->obter("on_op")."</span>":"<span class='err'>".$lingua->obter("off_op")."</span>"; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lingua->obter("magic_quotes");?></td>
                        <td><?= $lingua->obter("off_op");?></td>
                        <td><?= ($recomended[3])?"<span class='err'>".$lingua->obter("on_op")."</span>":"<span class='chk'>".$lingua->obter("off_op")."</span>"; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lingua->obter("global_reg");?></td>
                        <td><?= $lingua->obter("off_op");?></td>
                        <td><?= ($recomended[4])?"<span class='err'>".$lingua->obter("on_op")."</span>":"<span class='chk'>".$lingua->obter("off_op")."</span>"; ?></td>
                    </tr>
                    <tr>
                        <td><?= $lingua->obter("auto_session");?></td>
                        <td><?= $lingua->obter("off_op");?></td>
                        <td><?= ($recomended[5])?"<span class='err'>".$lingua->obter("on_op")."</span>":"<span class='chk'>".$lingua->obter("off_op")."</span>"; ?></td>
                    </tr>
               </table>
            </div>
        </div>
    </div>
