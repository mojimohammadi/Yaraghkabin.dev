<?php if(!\ahura\app\mw_options::get_mod_is_active_light_fontface()): ?>
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 100;
    src: url('../../fonts/fanum/woff/dana-fanum-thin.woff') format('woff'),
        url('../../fonts/fanum/woff2/dana-fanum-thin.woff2') format('woff2');
    font-display: swap;
    }
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 300;
    src: url('../../fonts/fanum/woff/dana-fanum-light.woff') format('woff');
        url('../../fonts/fanum/woff2/dana-fanum-light.woff2') format('woff2');
    font-display: swap;
    }
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_ultralight_fontface()): ?>
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 200;
    src: url('../../fonts/fanum/woff/dana-fanum-extralight.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-extralight.woff2') format('woff2');
    font-display: swap;
    }
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_medium_fontface()): ?>
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: normal;
    src: url('../../fonts/fanum/woff/dana-fanum-regular.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-regular.woff2') format('woff2');
    font-display: swap;
    }
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 500;
    src: url('../../fonts/fanum/woff/dana-fanum-medium.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-medium.woff2') format('woff2');
    font-display: swap;
    }
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_bold_fontface()): ?>
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 600;
    src: url('../../fonts/fanum/woff/dana-fanum-demibold.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-demibold.woff2') format('woff2');
    font-display: swap;
    }

    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 750;
    src: url('../../fonts/fanum/woff/dana-fanum-ultrabold.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-ultrabold.woff2') format('woff2');
    font-display: swap;
    }
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 800;
    src: url('../../fonts/fanum/woff/dana-fanum-extrabold.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-extrabold.woff2') format('woff2');
    font-display: swap;
    }
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: bold;
    src: url('../../fonts/fanum/woff/dana-fanum-bold.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-bold.woff2') format('woff2');
    font-display: swap;
    }
<?php endif; ?>
<?php if(!\ahura\app\mw_options::get_mod_is_active_black_fontface()): ?>
    @font-face {
    font-family: danafn;
    font-style: normal;
    font-weight: 900;
    src: url('../../fonts/fanum/woff/dana-fanum-black.woff') format('woff'),
    url('../../fonts/fanum/woff2/dana-fanum-black.woff2') format('woff2');
    font-display: swap;
    }
<?php endif; ?>
