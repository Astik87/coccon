<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if($arResult["OK_MESSAGE"] <> '')
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}

?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST" enctype="multipart/form-data" id="shopper-form">
<?=bitrix_sessid_post()?>
            <div class="one-line">
              <label class="name">
                <span>ФИО *</span>
                <input type="text" name="user_name">
              </label>
              
              <label class="activity">
                <span>Род деятельности *</span>
                <input type="text" name="activity">
              </label>
            </div>

						<div class="one-line off">
							<label class="channel">
                <span>Канал продаж *</span>
                <input type="text" name="channel">
              </label>

							<div class="offline-wrap">
                <span>Наличие оффлайн магазина:</span>
								<label class="offline">
									Да
									<span class="checkbox active" id="offline1"></span>
									<input type="radio" checked name="offline" value="Да" class="hide-block">
								</label>
								<label class="offline">
									Нет
									<span class="checkbox" id="offline0"></span>
									<input type="radio" name="offline" value="Нет" class="hide-block">
								</label>
							</div>
						</div>

						<div class="one-line">
							<label class="website">
                <span>Адрес сайта *</span>
                <input type="text" name="website">
              </label>

							<label class="instagram">
                <span> Адрес инстаграм аккаунта *</span>
                <input type="text" name="instagram">
              </label>
						</div>

						<div class="one-line">
							<label class="website">
                <span>Телефон *</span>
                <input type="tel" name="user_phone" placeholder="+_ ___ ___-__-__">
              </label>

							<label class="email">
                <span> E-mail *</span>
                <input type="email" name="user_email">
              </label>
						</div>
			<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
			<input class="submit" type="submit" name="submit" value="Отправить">
</form>

<script>
	$('.offline').on('click', function() {
		$('.offline .active').removeClass('active');
		$(this).find('.checkbox').addClass('active');
	});

	$('#shopper-form').ajaxForm({
		url: '<?=POST_FORM_ACTION_URI?>',
    type: 'post',
    success: d => {
			let res = JSON.parse(d);

			$('.error').removeClass('error');

			if (!res.result) {
				for(let name in res.errors) {
					$(`input[name="${name}"]`).parent().addClass('error');
				}
			} else {
				$('.shopper-modal').css('display', 'flex');;
			}
		}
	});
</script>

<?/*
<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
	<div class="mf-name">
		<div class="mf-text">
			<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
	</div>
	<div class="mf-email">
		<div class="mf-text">
			<?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
	</div>

	<div class="mf-message">
		<div class="mf-text">
			<?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<textarea name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>
	</div>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>
</div>