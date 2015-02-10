if (typeof PH == 'undefined') {	var PH = {Module:{}}; }

PH.Site = {

	picker_options: {
		format: 'dd/mm/yyyy',
		todayBtn: "linked",
		todayHighlight: true
	},

	init: function() {
		PH.Site.reusableModal();
		PH.Site.setupDatepickers();
		PH.Site.setupTabs();
		PH.Site.setupDeleteAction();
		PH.Site.setupCharts();
		PH.Site.setupTables();
		PH.Site.setupDropForms();
	},

	setupDropForms: function() {
		$('.dropdown-menu').on('click', function(e){
			if($(this).hasClass('drop-form')){
				e.stopPropagation();
			}
		});

		var that = this;
		$('.dropdown-menu a').on('click', function(e){
			e.preventDefault();
			$(this).toggleClass('active');

			that.refreshStatistics();
		});
	},

	refreshStatistics: function() {
		var ids = $('.dropdown-menu a.active').map(function() { return $(this).data('company-id'); }).get();
		var wrapper = $('#ajax-content-wrapper');
		var that = this;

		$.ajax({
			url: window.pathname,
			data: {
				clients: ids
			},
			beforeSend: function() {
				wrapper.animate({'opacity':0}, 400);
			},
			success: function(data1,data2,data3) {
				wrapper.html(jQuery(data1).filter('#ajax-content-wrapper').html());
				wrapper.animate({'opacity':1}, 400);
				that.setupCharts();
				that.setupTables();
			}
		});
	},

	setupTables: function() {
		$(".table").tablesorter({
				sortList: [[0,0]]
			});
	},

	setupTabs: function() {
		PH.Site.tabsHistory();

		// push redirect url into modal form
		$('body').on('shown.bs.modal', '.modal', function (e) {
			var form = $(e.target).find('form');
			form.append("<input type='hidden' name='ph_redirect' value='"+window.location.href+"' />");
		});
	},

	tabsHistory: function() {	
		if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');

		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			if(history.pushState) {
				history.pushState(null, null, '#'+$(e.target).attr('href').substr(1));
			} else {
				location.hash = '#'+$(e.target).attr('href').substr(1);
			}
		});
	},

	reusableModal: function() {
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	},

	setupDatepickers: function() {
		PH.Site.initDatepickers();
		$('body').on('shown.bs.modal', '.modal', function () {
			PH.Site.initDatepickers();
		});
	},

	initDatepickers: function() {
		$('.input-daterange, .datepicker').datepicker(PH.Site.picker_options);
	},

	setupDeleteAction: function() {
		var link;
		$('.delete').click(function(e) {
			e.preventDefault();
			link = $(this);

			$.ajax({
				url: link.attr('href'),
				type: 'DELETE',
				beforeSend: function() {
					if (!confirm("Are you sure?")) {
						return false;
					}
				},
				success: function() {
					link.parents('tr').remove();
				}
			});

			return false;
		});
	},

	setupCharts: function() {
		var chart_set = PH.Utilities.getInstance(PH.Module.ChartSet);
		chart_set.init();
	}
}

PH.Utilities = {
	getInstance: function(type) {
		return $.extend(true, {}, type);
	},

	modal: function(html) {
		var modal = $('#new-item-modal');
		modal.html("<div class='modal-dialog'><div class='modal-content'></div></div>");
		modal.find('.modal-content').first().append(html);
		modal.modal('show');
	}
}

$(document).ready(PH.Site.init);