<?php
namespace ahura\app\elementor;

if(!class_exists('\ahura\app\elementor\Ahura_Elementor'))
{
    return false;
}
use Elementor\Core\Files\CSS\Post as Post_CSS;
class Ahura_Elementor_Builder extends \ahura\app\elementor\Ahura_Elementor
{
    protected $content_id = 0;
    private $getInstance;

    public function __construct()
    {
        $this->getInstance = parent::instance();
    }

    /**
     *
     * Get elementor templates by post type
     *
     * @param $post_type
     * @return mixed
     */
    public function getTemplates($post_type = 'section_builder'){
        $templates = get_posts(['post_type' => $post_type]);
        return $templates;
    }

    /**
     *
     * Set content id for build
     *
     * @param $content_id
     */
    public function setContentID($content_id){
        $this->content_id = $content_id;
        return $this;
    }

    /**
     * 
     * Get content id
     * 
     * @return int
     */
    public function getContentID()
    {
        return $this->content_id;
    }

    /**
     * Get content translation id
     *
     * @return int
     */
    public function getContentTranslationID(){
        return ahura_get_content_translation_id($this->content_id);
    }

    /**
     *
     * Build custom element content
     *
     */
    public function build($with_css = false, $return_in_ajax = false){
        if(!$return_in_ajax && wp_doing_ajax()) return false;
        return $this->getInstance->frontend->get_builder_content($this->getContentTranslationID(), $with_css);
    }

    /**
     *
     * Build and display element content (with restore edit mode state)
     *
     */
    public function display($with_css = false, $return_in_ajax = false){
        if(!$return_in_ajax && wp_doing_ajax()) return false;
        return $this->getInstance->frontend->get_builder_content_for_display($this->getContentTranslationID(), $with_css);
    }

    /**
     * Print element inline css
     *
     * @return string
     */
    public function printCss(){
        if(!empty($this->getContentTranslationID()) && intval($this->getContentTranslationID()) && get_post_status($this->getContentTranslationID())){
            $css_file = new Post_CSS($this->getContentTranslationID());
			$css_file->print_css();
		}
    }

    /**
     *
     * Check is elementor preview page (preview is backend)
     *
     * @return boolean
     */
    public function isPreviewMode(){
        return $this->getInstance->preview->is_preview_mode();
    }

    /**
     * 
     * Check page is elementor edit mode
     * 
     * @return boolean
     */
    public function isEditMode(){
        $mode = get_post_meta($this->getContentID(), '_elementor_edit_mode', true);
        return ($mode === 'builder');
    }
}
