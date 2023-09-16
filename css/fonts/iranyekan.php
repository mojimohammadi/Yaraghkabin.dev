/*Load IRANYekan Fonts*/
<?php if(!\ahura\app\mw_options::get_mod_is_active_bold_fontface()): ?>
@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: bold;
	src: url('../../fonts/woff/iranyekanwebbold.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebbold.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebbold.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebbold.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: 800;
	src: url('../../fonts/woff/iranyekanwebextrabold.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebextrabold.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebextrabold.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebextrabold.ttf') format('truetype');
    <?php endif; ?>
    font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_light_fontface()): ?>
@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: 100;
	src: url('../../fonts/woff/iranyekanwebthin.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebthin.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebthin.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebthin.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: 300;
	src: url('../../fonts/woff/iranyekanweblight.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanweblight.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanweblight.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanweblight.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_medium_fontface()): ?>
@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: normal;
	src: url('../../fonts/woff/iranyekanwebregular.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebregular.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebregular.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebregular.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: 500;
	src: url('../../fonts/woff/iranyekanwebmedium.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebmedium.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebmedium.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebmedium.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_black_fontface()): ?>
@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: 900;
	src: url('../../fonts/woff/iranyekanwebblack.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebblack.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebblack.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebblack.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekan;
	font-style: normal;
	font-weight: 950;
	src: url('../../fonts/woff/iranyekanwebextrablack.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iranyekanwebextrablack.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff/iranyekanwebextrablack.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iranyekanwebextrablack.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
/*End Load IRANYekan Fonts*/