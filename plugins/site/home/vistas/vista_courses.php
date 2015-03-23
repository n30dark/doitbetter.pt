<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$cursos = $dados['cursos'];
?>
<div class="courses">
    <div class="top">
        <div class="up">Cursos 2012</div>
        <div class="down">em destaque</div>
    </div>
    <div class="content">
        <ul class="course_list">
        <?php foreach($cursos as $curso): ?>
            <li class="option"><a href="<?= BO_URL::obterHrefInterno("".$curso->aliasweb)?>"><?= $curso->titulo ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>