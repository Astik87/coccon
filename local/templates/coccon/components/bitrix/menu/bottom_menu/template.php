<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="item">
		<h3 class="title"><?= $arParams['TITLE'] ?></h3>
		<ul>
			<? foreach ($arResult as $item) : ?>
				<li><a href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a></li>
			<? endforeach; ?>
		</ul>
	</div>
<? endif; ?>