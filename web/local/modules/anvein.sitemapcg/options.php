<?php
use Bitrix\Main\Application;
use BItrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

global $USER;

if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}

$moduleName = 'anvein.sitemapcg';

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

Loc::loadMessages(__FILE__);


$tabControl = new CAdminTabControl(
    'tabControl',
    [
        [
            'DIV' => 'edit1',
            'TAB' => Loc::getMessage('anvein_sitemapcg_options_tab1_title_short'),
            'TITLE' => Loc::getMessage('anvein_sitemapcg_options_tab1_title'),
        ]
    ],
    true
);

/**
 * Проверка настроек и сохранение (если нажали Применить/Сохранить)
 */
$oCAdminMessage = new CAdminMessage([]);
if ((!empty($save) || !empty($apply) || !empty($restore)) && $request->isPost() && check_bitrix_sessid()) {
    if (!empty($restore)) {
        Option::delete($moduleName);
        $oCAdminMessage->ShowMessage([
            'MESSAGE' => Loc::getMessage('anvein_sitemapcg_options_restored'),
            'TYPE' => 'OK',
        ]);
    } else {
        $error = '';
        $fields = [

        ];

        // валидация
        foreach ($fields as $key => $field) {
            if (isset($field['required']) && $field['required'] === true && trim($request->getPost($key)) === '') {
                $error .= Loc::getMessage('anvein_sitemapcg_options_field') .
                    Loc::getMessage('anvein_sitemapcg_option_label_' . $key) .
                    Loc::getMessage('anvein_sitemapcg_options_required');
            }
        }

        // сохранение
        if (!$error) {
            foreach ($fields as $field) {
                if ($request->getPost($field) !== null) {
                    Option::set(
                        $moduleName,
                        $field,
                        $request->getPost($field)
                    );
                }
            }

            $oCAdminMessage->ShowMessage([
                'MESSAGE' => Loc::getMessage('anvein_sitemapcg_options_save_success'),
                'TYPE' => 'OK',
            ]);

        } else {
            $oCAdminMessage->ShowMessage([
                'MESSAGE' => $error,
                'TYPE' => 'ERROR',
            ]);
        }
    }
}
?>

<?php
$tabControl->begin();
$tabControl->beginNextTab();
?>
<form method="POST" action="<?= sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID) ?>">
    <?php echo bitrix_sessid_post(); ?>
    <table class="adm-detail-content-table">
        <tr>
            <td width="40%">
                <label><?= Loc::getMessage('anvein_sitemapcg_options_log_level1') ?>:</label>
            </td>

            <?php /*
            <td width="60%">
                <input type="hidden" name="log_level_1" value=""/>
                <input
                    type="checkbox"
                    name="log_level_1"
                    value="1"
                    <?= (Option::get($moduleName, 'log_level_1')) ? 'checked' : ''; ?>
                />
            </td>
            */ ?>
        </tr>

        <?php
        $tabControl->endTab();
        $tabControl->buttons([]);
        ?>
    </table>
</form>
<?php $tabControl->end(); ?>