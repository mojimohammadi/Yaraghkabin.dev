<?php
$image_attributes = wp_get_attachment_image_src(get_the_ID(), $settings['item_cover_size']);
$url = isset($image_attributes[0]) ? $image_attributes[0] : '';
?>
<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
    <a href="<?php echo $url; ?>" class="gallery-item-box" style="background-image:url(<?php echo $url; ?>)"></a>
</div>