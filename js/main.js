jQuery(function($) {

	// initializes section tabs and binds tab events for a certain form
	var initSectionTabs = function(form_id) {
		// get form ID
		var $form = $('#gform_' + form_id);

		// make sure that form is there, section tabs are enabled and are not yet initialized
		if ($form.length && $form.hasClass('gravity_forms_section_tabs_enabled') && !$form.hasClass('gravity_forms_section_tabs_initialized')) {

			// if there are no sections, bail
			var tabs = $form.find('.gsection');
			if (!tabs.length) {
				return true;
			}

			// insert tabs head wrapper
			var tabsHead = $('<li class="gravity-forms-section-tabs-head"></li>');
			tabsHead.insertBefore(tabs.eq(0));

			// build tabs
			tabs.each(function() {
				// add a tab head link for each tab
				tabsHead.append('<a href="#">' + $(this).find('.gsection_title').html() + '</a>');

				// move the corresponding fields to their tab body
				var gformFields = $('<ul class="gform_fields">');
				$(this).append(gformFields);
				$(this).nextUntil('.gsection', '.gfield').appendTo(gformFields);
			});

			// handle tab head clicks
			tabsHead.find('a').on('click', function(event) {
				if ($(this).hasClass('current')) {
					return false;
				}

				var idx = tabsHead.find('a').index($(this));
				$form.find('.gsection:eq(' + idx + ')').show().siblings('.gsection').hide();
				tabsHead.find('a.current').removeClass('current');
				$(this).addClass('current');

				event.preventDefault();
			}).filter(':eq(0)').trigger('click');

			// mark the section tabs of this form as initialized
			$form.addClass('gravity_forms_section_tabs_initialized');

			// trigger a custom "section tabs initialization completed" event for that form
			$(document).trigger('gravity_forms_section_tabs_initialized', form_id);

		}
	}

	// initialize section tabs after form rendering
	$(document).on('gform_post_render', function(event, form_id, current_page) {
		initSectionTabs(form_id);
	});

	// in case gform_post_render is not called, initialize the section tabs
	$('form.gravity_forms_section_tabs_enabled').each(function() {
		initSectionTabs($(this).attr('id').replace('gform_', ''));
	});

});