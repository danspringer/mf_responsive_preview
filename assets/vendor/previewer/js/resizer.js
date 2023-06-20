$(document).ready(function(){

	var scaleCount = 0;

	var scaleNow = 1;
	var resX = 390;
	var resY = 800;

	var mouseIsDown = false;
	var resizeDirection = null;
	var elOffsetX = 0;
	var elOffsetY = 0;

	var isResponsive = true;


	let headerResolutionInput = $('#header .resolution input');
	let lineHorizontal = $('#linehorizontal');
	let lineVertical = $('#linevertical');
	let viewer = $('#viewer');
	let viewerIframe = $('#viewer iframe');
	let htmlElement = $('html');

	function deviceTransition(resX, resY, scale, duration) {
		if (!isResponsive) {
			scale = resX <= 1024 ? resX / 1024 : 1;
		} else {
			scale = 1;
		}

		headerResolutionInput.val(resX + 'x' + resY);

		lineHorizontal.transition({ width: resX }, duration).find('.center').text(resX + 'px');
		lineHorizontal.find('.left, .right').transition({ width: (resX / 2 - 50) }, duration);

		let windowWidth = $(window).width();
		let viewerPositionTop = viewer.position().top;

		$('#rotate').transition({ 'left': (windowWidth / 2 - (resX / 2) - 110) }, duration);

		lineVertical.find('.middle').text(resY + 'px');
		lineVertical.transition({ 'top': (viewerPositionTop + 50), 'left': (windowWidth / 2 - (resX / 2) - 120) }, duration);
		lineVertical.find('.top, .bottom').transition({ height: (resY / 2 - 12) }, duration);

		viewer.transition({ width: resX, height: resY }, duration, function() {});

		viewerIframe.transition({ scale: scale, 'width': resX / (scale / 1), 'height': resY / (scale / 1) }, duration);

		htmlElement.transition({ 'min-width': (resX + 100) }, duration, function() {
		});

	}

	// Create the pixel display
	let divsT = '';
	let divsPixel = '<div><span>${i * 100}</span></div>' + '<div></div>'.repeat(9);
	for (let i = 0; i < 20; i++) {
		divsT += divsPixel;
	}
	$('#pixelhorizontal').append(divsT);
	$('#pixelvertical').html(divsT);

	const headerNav = $('#header nav');
	const tooltip = $('#tooltip');
	const whichDeviceSpan = $('#whichdevice span');

	headerNav.find('a').click(function(e) {
		e.preventDefault();
		$("#header nav a").removeClass('active');
		$(this).addClass('active');

		const resolution = $(this).data('res').split('x');
		const resX = parseInt(resolution[0]);
		const resY = parseInt(resolution[1]);

		deviceTransition(resX, resY, scaleNow, 500);

		whichDeviceSpan.html($(this).data('tooltip'));
	}).mouseenter(function(e) {
		tooltip.html($(this).data('tooltip')).css({
			'display': 'block',
			'top': ($(this).offset().top + $(this).outerHeight() + 15),
			'left': ($(this).offset().left - tooltip.outerWidth() / 2 + $(this).outerWidth() / 2),
			'opacity': '.75'
		});
	}).mouseleave(function() {
		tooltip.css({
			'opacity': 0,
			'display': 'none'
		});
	});

	// Cache frequently used selectors
	var $resolution = $('#header .resolution');

// Use event delegation on a parent element closer to the target
	$(document).on('submit', $resolution, function(e) {
		e.preventDefault();

		var t = $(this).find('input').val();
		var isResolution = /^([0-9]+)x([0-9]+)$/;

		if (isResolution.test(t)) {
			var resX = RegExp.$1;
			var resY = RegExp.$2;
			deviceTransition(resX, resY, scaleNow, 400);
		}
	});

	deviceTransition( resX, resY, scaleNow, 50 );

	// Rotate the resolution
	$('#rotate').click(function(e){
		e.preventDefault();
		let coords = $('#resolution').val();
		coords = coords.split('x');
		// Switch Positions
		let resX = coords[1];
		let resY = coords[0];
		deviceTransition( resX, resY, scaleNow, 400 );
	});

	// Functionality for resizing the box
	$('#viewer').mousemove(function(e) {
		var $this = $(this);
		var offset = $this.offset();
		var outerWidth = $this.outerWidth();
		var outerHeight = $this.outerHeight();
		var cursor = 'auto';

		if (e.pageX <= offset.left + 20 && e.pageY >= offset.top + outerHeight - 20) {
			cursor = 'sw-resize';
		} else if (e.pageX >= offset.left + outerWidth - 20 && e.pageY >= offset.top + outerHeight - 20) {
			cursor = 'se-resize';
		} else if (e.pageY >= offset.top + outerHeight - 20) {
			cursor = 's-resize';
		} else if (e.pageX >= offset.left + outerWidth - 20) {
			cursor = 'e-resize';
		} else if (e.pageX <= offset.left + 20) {
			cursor = 'w-resize';
		}

		$this.css('cursor', cursor);
	});

	$('#viewer').mousedown(function(e) {
		var $this = $(this);
		var offset = $this.offset();
		var outerWidth = $this.outerWidth();
		var outerHeight = $this.outerHeight();
		var pageX = e.pageX;
		var pageY = e.pageY;

		if (pageX <= (offset.left + 20) && pageY >= (offset.top + outerHeight - 20)) {
			elOffsetX = pageX - offset.left;
			elOffsetY = offset.left + outerHeight - pageY;
			resizeDirection = 'sw';
			mouseIsDown = true;
		} else if (pageX >= (offset.left + outerWidth - 20) && pageY >= (offset.top + outerHeight - 20)) {
			elOffsetX = offset.left + outerWidth - pageX;
			elOffsetY = offset.left + outerHeight - pageY;
			resizeDirection = 'se';
			mouseIsDown = true;
		} else if (pageY >= (offset.top + outerHeight - 20)) {
			elOffsetY = offset.left + outerHeight - pageY;
			resizeDirection = 's';
			mouseIsDown = true;
		} else if (pageX >= (offset.left + outerWidth - 20)) {
			elOffsetX = offset.left + outerWidth - pageX;
			resizeDirection = 'e';
			mouseIsDown = true;
		} else if (pageX <= (offset.left + 20)) {
			elOffsetX = pageX - offset.left;
			resizeDirection = 'w';
			mouseIsDown = true;
		}
	});

	$('body').mousemove(function(e){

		if (mouseIsDown) {
			$('#overlay').show();

			if (resizeDirection === 'w' || resizeDirection === 'sw') {
				newWidth = Math.max(Math.min(Math.round(($(window).width() - (e.pageX + elOffsetX) * 2)), 1600), 320);
				resX = newWidth;
			}

			if (resizeDirection === 'e' || resizeDirection === 'se') {
				newWidth = Math.max(Math.min(Math.round((e.pageX - elOffsetX - $('#viewer').offset().left)), 1600), 320);
				resX = newWidth;
			}

			if (resizeDirection === 's' || resizeDirection === 'sw' || resizeDirection === 'se') {
				newHeight = Math.max(Math.min(Math.round((parseInt($('#viewer').scrollTop()) + parseInt(e.pageY)) - 200), 2000), 320);
				resY = newHeight;
			}

			deviceTransition(resX, resY, scaleNow, 0);

			$('#header .active').removeClass('active');
			$('#whichdevice span').text('Individuell');
		}

	});

	$('body').mouseup(function(e){
		$('#overlay').hide();
		mouseIsDown = false;
	});

	$('body').mouseleave(function(){
		$('#overlay').hide();
		mouseIsDown = false;
	});

	// set position to linevertical
	$(window).resize(function(e){
		deviceTransition( resX, resY, scaleNow, 1 );
	});

	$(window).trigger('resize');


	$(window).scroll(function(){
		$('#warning, #waring-2').hide();
	});

	$('[data-bs-toggle="tooltip"]').tooltip()

});


