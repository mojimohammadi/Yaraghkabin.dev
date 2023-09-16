 /**
*
*	Name:			Anjoman Fonts
*	Version:			2.0
*	Author:			Moslem Ebrahimi (moslemebrahimi.com)
*	Created on:		April 4, 2020
*	Updated on:		April 4, 2020
*	Website:			http://fontiran.com
*	Copyright:		Commercial/Proprietary Software
--------------------------------------------------------------------------------------
فونت انجمن یک نرم افزار مالکیتی محسوب می شود. جهت آگاهی از قوانین استفاده از این فونت ها لطفا به وب سایت (فونت ایران دات کام) مراجعه نمایید
--------------------------------------------------------------------------------------
Anjoman fonts are considered a proprietary software. To gain information about the laws regarding the use of these fonts, please visit www.fontiran.com 
--------------------------------------------------------------------------------------
This set of fonts are used in this project under the license: (XM7RMY)
------------------------------------------------------------------------------------- fonts/-
*	
**/
<?php if(!\ahura\app\mw_options::get_mod_is_active_light_fontface()): ?>
@font-face {
	font-family: anjoman;
	font-style: normal;
	font-weight: 300;
	src: url('../../fonts/woff/Anjoman-Light.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/Anjoman-Light.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff2/Anjoman-Light.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/woff/Anjoman-Light.woff') format('woff');  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_medium_fontface()): ?>
@font-face {
	font-family: anjoman;
	font-style: normal;
	font-weight: normal;
	src: url('../../fonts/woff/Anjoman-Regular.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/Anjoman-Regular.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff2/Anjoman-Regular.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/woff/Anjoman-Regular.woff') format('woff');  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_bold_fontface()): ?>
@font-face {
	font-family: anjoman;
	font-style: normal;
	font-weight: bold;
	src: url('../../fonts/woff/Anjoman-Bold.woff');
    <?php if(\ahura\app\mw_options::is_active_another_font_types()): ?>
	src: url('../../fonts/eot/Anjoman-Bold.eot?#iefix') format('embedded-opentype'),  /* IE6-8 */
		 url('../../fonts/woff2/Anjoman-Bold.woff2') format('woff2'),  /* FF39+,Chrome36+, Opera24+*/
		 url('../../fonts/woff/Anjoman-Bold.woff') format('woff');  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
    <?php endif; ?>
	font-display: swap;
}
<?php endif; ?>
