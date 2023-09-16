/*Load IRANYekanFN Fonts*/
<?php if(!\ahura\app\mw_options::get_mod_is_active_bold_fontface()): ?>
@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: bold;
	src: url('../../fonts/fanum/woff/iranyekanwebboldfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebboldfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebboldfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebboldfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_light_fontface()): ?>
@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: 100;
	src: url('../../fonts/fanum/woff/iranyekanwebthinfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebthinfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebthinfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebthinfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: 300;
	src: url('../../fonts/fanum/woff/iranyekanweblightfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanweblightfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanweblightfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanweblightfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_medium_fontface()): ?>
@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: normal;
	src: url('../../fonts/fanum/woff/iranyekanwebregularfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebregularfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebregularfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebregularfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: 500;
	src: url('../../fonts/fanum/woff/iranyekanwebmediumfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebmediumfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebmediumfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebmediumfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_black_fontface()): ?>
@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: 800;
	src: url('../../fonts/fanum/woff/iranyekanwebextraboldfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebextraboldfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebextraboldfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebextraboldfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: 900;
	src: url('../../fonts/fanum/woff/iranyekanwebblackfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebblackfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebblackfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebblackfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}

@font-face {
	font-family: iranyekanfn;
	font-style: normal;
	font-weight: 950;
	src: url('../../fonts/fanum/woff/iranyekanwebextrablackfanum.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/iranyekanwebextrablackfanum.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff/iranyekanwebextrablackfanum.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/iranyekanwebextrablackfanum.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
/*End Load IRANYekanFN Fonts*/