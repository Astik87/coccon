"use strict";
! function (e) {
	e(function () {

		BX.addCustomEvent('OnBasketChange', () => {
			BX.Sale.OrderAjaxComponent.sendRequest('refreshOrderAjax');
			// $('.bx-soa-cart-total').css('display', 'none')
			// $('#bx-soa-total .bx-soa-cart-total').css('display', 'block');
		});

	})
}(jQuery);