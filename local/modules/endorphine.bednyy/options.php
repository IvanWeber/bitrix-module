<?php

use BitrixMainConfigOption;

if ($_SERVER["REQUEST_METHOD"] === "POST" && check_bitrix_sessid()) {
    Option::set("endorphine.bednyy", "dadata_token", $_POST["dadata_token"]);
}

$token = Option::get("endorphine.bednyy", "dadata_token", "");

?>

<form method="POST">
    <?= bitrix_sessid_post() ?>
    <label for="dadata_token">Токен DaData:</label>
    <input type="text" name="dadata_token" value="<?= htmlspecialcharsbx($token) ?>" />
    <input type="submit" value="Сохранить">
</form>
