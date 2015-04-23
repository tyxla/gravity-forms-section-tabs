jQuery(function($) {

	var initSectionTabs = function(form_id) {
		var $form = $('#gform_' + form_id);
		if ($form.length && $form.hasClass('gravity_forms_section_tabs_enabled') && !$form.hasClass('gravity_forms_section_tabs_initialized')) {

			var tabs = $form.find('.gsection');
			if (!tabs.length) {
				return true;
			}

			var tabsHead = $('<li class="gravity-forms-section-tabs-head"></li>');
			tabsHead.insertBefore(tabs.eq(0));

			tabs.each(function() {
				tabsHead.append('<a href="#">' + $(this).find('.gsection_title').html() + '</a>');

				var gformFields = $('<ul class="gform_fields">');
				$(this).append(gformFields);
				$(this).nextUntil('.gsection', '.gfield').appendTo(gformFields);
			});

			$form.addClass('gravity_forms_section_tabs_initialized');

			tabsHead.find('a').on('click', function() {
				if ($(this).hasClass('current')) {
					return false;
				}

				var idx = tabsHead.find('a').index($(this));
				$form.find('.gsection:eq(' + idx + ')').show().siblings('.gsection').hide();
				tabsHead.find('a.current').removeClass('current');
				$(this).addClass('current');
			}).filter(':eq(0)').trigger('click');

		}
	}

	$(document).on('gform_post_render', function(event, form_id, current_page) {
		initSectionTabs(form_id);
	});

	$('form.gravity_forms_section_tabs_enabled').each(function() {
		initSectionTabs($(this).attr('id').replace('gform_', ''));
	});

});