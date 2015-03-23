<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<div class="search">
    <div class="title">pesquisa rápida</div>
    <form>
        <div class="p">
            <label for="datainicio">de</label>
            <input type="text" name="datainicio" class="date" id="datainicio">
            <div class="calendar" id="cal_datainicio"></div>
            <label for="datafinal" id="datafinal">a</label>
            <input type="text" name="datafinal" class="date" id="datafinal">
            <div class="calendar" id="cal_datafinal"></div>
        </div>
        <div class="p">
            <label for="oque">O quê</label>
            <select name="oque" class="dropdown">
                <option value=""></option>
            </select>                          
        </div>
        <div class="p">
            <label for="pais">O quê</label>
            <select name="pais" class="dropdown">
                <option value=""></option>
            </select>                          
        </div>
        <div class="p">
            <label for="cidade">O quê</label>
            <select name="cidade" class="dropdown">
                <option value=""></option>
            </select>                          
        </div>
        <div class="p">
            <input type="submit" name="submit" value="pesquisar" id="submit" />
        </div>
    </form>
</div>