<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<ul class="menu" id="menu">

		<li class="header__icons--mobil">
			<div class="header__icons">
				<!-- Search -->
				<div class="header__icon search">
					<div class="search-field">
						<input type="text" class="search__input" placeholder="Введите запрос...">
						<svg class="search__close">
							<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#close"> </use>
						</svg>
					</div>

					<a href="#" class="search__icon">
						<svg>
							<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#search"> </use>
						</svg>
					</a>

				</div>
				<!-- End Search -->

				<a class="header__icon" id="user" <?= $USER->IsAuthorized() ? 'href="#"' : "" ?>>
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#woman"> </use>
					</svg>
				</a>
				<a href="#" class="header__icon">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
				</a>
				<a href="#" class="header__icon cart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
					</svg>

					<div class="cart-count" id="cart-count">
						<span>2</span>
					</div>
				</a>
			</div>
		</li>

		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>
			<? if ($arItem["SELECTED"]) : ?>
				<li><a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
			<? else : ?>
				<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
			<? endif ?>

		<? endforeach ?>

	</ul>
<? endif ?>