/*Load IRANSansDN Fonts*/
<?php if(!\ahura\app\mw_options::get_mod_is_active_bold_fontface()): ?>
@font-face {
	font-family: iransansdn;
	font-style: normal;
	font-weight: bold;
	src: url('../../fonts/woff/iransansdnbold.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iransansdnbold.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff2/iransansdnbold.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/woff/iransansdnbold.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iransansdnbold.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_light_fontface()): ?>
@font-face {
	font-family: iransansdn;
	font-style: normal;
	font-weight: 300;
	src: url('../../fonts/woff/iransansdnlight.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iransansdnlight.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff2/iransansdnlight.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/woff/iransansdnlight.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iransansdnlight.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_medium_fontface()): ?>
@font-face {
	font-family: iransansdn;
	font-style: normal;
	font-weight: normal;
	src: url('../../fonts/woff/iransansdn.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/iransansdn.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff2/iransansdn.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/woff/iransansdn.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/ttf/iransansdn.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
/*End Load IRANSansDN Fonts*/