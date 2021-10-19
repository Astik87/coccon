<?	global $APPLICATION;

use Bitrix\Main\Config\Option;

CJSCore::Init(array("jquery"));
	$widget_url = trim(Option::get('up.boxberrydelivery', 'WIDGET_URL'));
	$APPLICATION->AddHeadScript($widget_url);
?>

<div id="boxberry_widget"></div>

<script>
	boxberry.openOnPage('boxberry_widget'); 
	boxberry.open('', '1$DCIlCpOeh0NkfiVjTUQNEQ8fPbjnIldR','','', '', 100);
</script>