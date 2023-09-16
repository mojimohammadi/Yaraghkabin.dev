/*Load IRANSansFaNum Font*/
<?php if(!\ahura\app\mw_options::get_mod_is_active_black_fontface()): ?>
@font-face {
	font-family: IRANSansFaNum;
	font-style: normal;
	font-weight: 900;
	src: url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Black.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/IRANSansWeb(FaNum)_Black.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff2/IRANSansWeb(FaNum)_Black.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Black.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/IRANSansWeb(FaNum)_Black.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_bold_fontface()): ?>
@font-face {
	font-family: IRANSansFaNum;
	font-style: normal;
	font-weight: bold;
	src: url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Bold.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/IRANSansWeb(FaNum)_Bold.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff2/IRANSansWeb(FaNum)_Bold.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Bold.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/IRANSansWeb(FaNum)_Bold.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_medium_fontface()): ?>
@font-face {
	font-family: IRANSansFaNum;
	font-style: normal;
	font-weight: 500;
	src: url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Medium.woff');
   <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/IRANSansWeb(FaNum)_Medium.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff2/IRANSansWeb(FaNum)_Medium.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Medium.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/IRANSansWeb(FaNum)_Medium.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
@font-face {
	font-family: IRANSansFaNum;
	font-style: normal;
	font-weight: normal;
	src: url('../../fonts/fanum/woff/IRANSansWeb(FaNum).woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/IRANSansWeb(FaNum).eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff2/IRANSansWeb(FaNum).woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/fanum/woff/IRANSansWeb(FaNum).woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/IRANSansWeb(FaNum).ttf') format('truetype');
    <?php endif; ?>
    font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_light_fontface()): ?>
@font-face {
	font-family: IRANSansFaNum;
	font-style: normal;
	font-weight: 300;
	src: url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Light.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/IRANSansWeb(FaNum)_Light.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff2/IRANSansWeb(FaNum)_Light.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_Light.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/IRANSansWeb(FaNum)_Light.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_ultralight_fontface()): ?>
@font-face {
	font-family: IRANSansFaNum;
	font-style: normal;
	font-weight: 200;
	src: url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_UltraLight.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/fanum/eot/IRANSansWeb(FaNum)_UltraLight.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/fanum/woff2/IRANSansWeb(FaNum)_UltraLight.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/fanum/woff/IRANSansWeb(FaNum)_UltraLight.woff') format('woff'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
		 url('../../fonts/fanum/ttf/IRANSansWeb(FaNum)_UltraLight.ttf') format('truetype');
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>