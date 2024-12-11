<?php
use BitrixMainLoader;
use BitrixMainModuleManager;
use BitrixMainConfigOption;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin.php");

if ($REQUEST_METHOD == "POST" && check_bitrix_sessid()) {
    Option::set('endorphine.<ВАША_ФАМИЛИЯ>', 'dadata_token', $_POST['dadata_token']);
}

$dadataToken = Option::get('endorphine.<ВАША_ФАМИЛИЯ>', 'dadata_token');
?>

<form method="POST">
    <?= bitrix_sessid_post(); ?>
    <label for="dadata_token">Токен Dadata:</label>
    <input type="text" name="dadata_token" value="<?= htmlspecialchars($dadataToken); ?>">
    <input type="submit" value="Сохранить">
</form>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php"); ?>
