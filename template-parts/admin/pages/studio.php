<?php
use ahura\app\license;
use ahura\app\Ahura_Alert;

$tabs = \ahura\app\Studio::get_filter_tabs();
$demos = \ahura\app\Studio_Demo::get_demo_list();
$demo_options = \ahura\app\Studio_Demo::get_demo_options();
$demo_base_url = \ahura\app\Studio::get_base_url();
$tabs_cls_arr = array_map(function ($i){
    return "." . $i;
}, array_keys($tabs));
?>
<div class="wrap">
    <h1 class="wp-heading-inline"></h1>
    <hr class="wp-header-end">
    <div class="studio-content">
		<?php if(license::check_license()): ?>
        <div class="ahura-filter-tabs">
            <ul>
                <li class="active"><a href="#" data-filter="<?php echo implode(',', $tabs_cls_arr) ?>"><?php echo esc_attr__('All', 'ahura') ?></a></li>
                <?php foreach($tabs as $key => $value): ?>
                    <li><a href="#" data-filter=".<?php echo $key ?>"><?php echo $value ?></a></li>
                <?php endforeach; ?>
                <li class="search-toggle"><span class="dashicons dashicons-search"></span></li>
            </ul>
            <div class="search-wrap" style="display:none;">
                <input type="text" placeholder="<?php _e('Search...', 'ahura') ?>">
            </div>
        </div>
        <div class="ahura-filter-tab-items ahura-studio-filter-tab-items">
            <?php if($demos): ?>
                <?php 
                $i = 0;
                    foreach($demos as $demo):
						$title = $demo['import_file_name'];
                        $cat = isset($demo['import_demo_cat']) ? $demo['import_demo_cat'] : '';
                        $name = isset($demo['import_demo_name']) ? $demo['import_demo_name'] : '';
                        $demo_slug = isset($demo['import_demo_id']) ? $demo['import_demo_id'] : $name;
                        $demo_img = isset($demo['import_demo_img']) ? $demo['import_demo_img'] : '';
                    ?>
                <div class="filter-item <?php echo $cat ?>" data-cat="<?php echo $cat ?>">
                    <div class="filter-item-content">
                        <div class="filter-item-cover" data-demo-preview-url="<?php echo $demo_img ?>">
                            <?php if($demo_options): ?>
                            <div class="filter-item-options">
                                <ul class="merlin__drawer merlin__drawer--import-content js-merlin-drawer-import-content">
                                    <?php foreach ($demo_options as $key => $value): ?>
                                        <li class="merlin__drawer--import-content__list-item status status--Pending" data-content="<?php echo $key ?>">
                                            <div class="round-check-wrap">
                                                <div class="round-check">
                                                    <input type="checkbox" name="default_content[<?php echo $key ?>]" class="checkbox checkbox-<?php echo $key ?>" id="default_content_<?php echo $key ?>_<?php echo $demo_slug ?>" value="1" checked>
                                                    <label for="default_content_<?php echo $key ?>_<?php echo $demo_slug ?>"></label>
                                                </div>
                                                <label for="default_content_<?php echo $key ?>_<?php echo $demo_slug ?>">
                                                    <i></i><span><?php echo $value ?></span>
                                                </label>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="float-options">
                                <span class="float-item show-demo-options"><i class="dashicons dashicons-screenoptions"></i></span>
                                <a href="<?php echo site_url() ?>" target="_blank" class="float-item home-link"><i class="dashicons dashicons-admin-home"></i></a>
                            </div>
                            <?php endif; ?>
                            <div class="filter-item-cover-loading">
                                <div class="loader-dots">
                                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                                </div>
                            </div>
                        </div>
                        <h3 class="filter-item-title"><?php echo $title ?></h3>
                        <div class="filter-item-btns">
                            <a href="<?php echo $demo_base_url ?>demo/ahura/<?php echo $name ?>/" class="studio-preview-demo" target="_blank"><?php echo esc_html__('Preview', 'ahura') ?></a>
                            <a href="#" class="studio-install-demo" data-callback="install_content" data-demo-title="<?php echo $title ?>" data-demo-id="<?php echo $i ?>" data-demo-slug="<?php echo $demo_slug ?>">
                                <div class="btn-progress" style="width:0"></div>
                                <span><?php echo esc_html__('Import Demo', 'ahura') ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                $i++;
            endforeach; ?>
            <?php endif; ?>
        </div>
		<?php
		else:
			Ahura_Alert::adminNotice(esc_html__('Please active ahura theme license.', 'ahura'), Ahura_Alert::WARNING);
		endif; 
		?>
    </div>
</div>