(function ($, window, document) {
'use strict';

var fc;

var FawkesChat = (function(){
	FawkesChat = function(){
		this.tableHolder = $('#tableHolder');
		this.chatter = $('#chatter');
	}
	FawkesChat.prototype.init = function(){
		fc.refreshTable();
		$('#witty').on('click', fc.getWit);

		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {

				$.ajax({
					url: 'includes/save_region.php',
					data: {
						'lat': position.coords.latitude,
						'lng': position.coords.longitude
					},
					type: 'POST'
				});
			});
		}
	};
	FawkesChat.prototype.refreshTable = function(){
		fc.tableHolder.load('includes/load_chats.php', function(){
			setTimeout(fc.refreshTable, 5000);
		});
	};
	FawkesChat.prototype.getWit = function(e){
		$.get("includes/get_witty_comeback.php", function(data) {
			fc.chatter.text(data);
		});
		e.preventDefault();
	};
	return FawkesChat;
})();

$(function() {
	$.ajaxSetup ({ cache: false	});
	fc = new FawkesChat();
	fc.init();
});
}(window.jQuery, window, document));