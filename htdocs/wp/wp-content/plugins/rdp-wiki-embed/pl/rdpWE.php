<?php if ( ! defined('WP_CONTENT_DIR')) exit('No direct script access allowed'); ?>
<?php


class RDP_WIKI_EMBED {
    private $_version = '';
    private $_options = array();    
    private $_resource = '';    
    private $_default_settings = array();
    
    public function __construct($version,$props){
        foreach ($props as $key => $value ) {
            $newvalue = (isset($props[$key])) ? $props[$key] : null;
            if ($newvalue === "true") $newvalue = true;
            if ($newvalue === "false") $newvalue = false;
            $this->$key = $newvalue;
        } 
        $this->_version = $version;
    }//__construct
    
    
    public function shortcode( $atts ) {
        $url = (isset($atts['url']))? $atts['url'] : '' ;
        
        // Remove all illegal characters from a url
        $url = filter_var($url, FILTER_SANITIZE_URL);
        
        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL) === false){
            $msg = __("ERROR: Not a valid wiki URL.",'rdp-wiki-embed');
            return RDP_WIKI_EMBED_UTILITIES::showMessage('ERROR: Not a valid wiki URL.', true, false);
        }         
        
        $whitelist = empty($this->_options['whitelist'])? '' : $this->_options['whitelist'];
        $fPassURLCheck = RDP_WIKI_EMBED_UTILITIES::passURLCheck($url, $whitelist);
        if(!$fPassURLCheck){
            $msg = __("ERROR: This url does not meet the site security guidelines.",'rdp-wiki-embed');
            return RDP_WIKI_EMBED_UTILITIES::showMessage($msg, true, false);
        }
        
        $attrs =shortcode_atts( array(
            'url'         => '',
            'wiki_update'      => (isset($this->_options['wiki_update']))? intval($this->_options['wiki_update']): 1440, 
            'wiki_links'      => (isset($this->_options['wiki_links']))? $this->_options['wiki_links']: $this->_default_settings['wiki_links'], 
            'global_content_replace' => (isset($this->_options['global_content_replace']))? intval($this->_options['global_content_replace']): $this->_default_settings['global_content_replace'], 
            'global_content_replace_template' => (isset($this->_options['global_content_replace_template']))? $this->_options['global_content_replace_template']: $this->_default_settings['global_content_replace_template'], 
            'remove'      => '',
            'wiki_links_open_new'  => (isset($this->_options['wiki_links_open_new']))? intval($this->_options['wiki_links_open_new']): 0,
            'source_show'  => (isset($this->_options['source_show']))? $this->_options['source_show']: 1,
            'pre_source'  => (isset($this->_options['pre_source']))? $this->_options['pre_source']:  $this->_default_settings['pre_source'],
            'edit_show'     => (isset($this->_options['edit_show']))? intval($this->_options['edit_show']): 0,
            'toc_show' => (isset($this->_options['toc_show']))? intval($this->_options['toc_show']): 0,
            'infobox_show'  => (isset($this->_options['infobox_show']))? intval($this->_options['infobox_show']): 1,
            'unreferenced_show'  => (isset($this->_options['unreferenced_show']))? intval($this->_options['unreferenced_show']): 0,
            'admin_nav_show'  => (isset($this->_options['admin_nav_show']))? intval($this->_options['admin_nav_show']): 0,
            'footer_show'  => (isset($this->_options['footer_show']))? intval($this->_options['footer_show']): 0,
        ), $atts ); 
         
        if(!is_numeric($attrs['wiki_update']))$attrs['wiki_update'] = $this->_default_settings['wiki_update'];         
        if(!is_numeric($attrs['global_content_replace']))$attrs['global_content_replace'] = $this->_default_settings['global_content_replace'];                
        if(!is_numeric($attrs['edit_show']))$attrs['edit_show'] = $this->_default_settings['edit_show'];         
        if(!is_numeric($attrs['toc_show']))$attrs['toc_show'] = $this->_default_settings['toc_show'];         
        if(!is_numeric($attrs['infobox_show']))$attrs['infobox_show'] = $this->_default_settings['infobox_show'];         
        if(!is_numeric($attrs['unreferenced_show']))$attrs['unreferenced_show'] = $this->_default_settings['unreferenced_show'];         
        if(!is_numeric($attrs['admin_nav_show']))$attrs['admin_nav_show'] = $this->_default_settings['admin_nav_show'];         
        if(!is_numeric($attrs['footer_show']))$attrs['footer_show'] = $this->_default_settings['footer_show'];         
        if(!in_array( $attrs['wiki_links'], RDP_WIKI_EMBED_PLUGIN::link_settings() ))$attrs['wiki_links'] = $this->_default_settings['wiki_links'];          
        
        // add shortcode attrs as class-level properties
        foreach ($attrs as $key => $value ) {
            $newvalue = (isset($attrs[$key])) ? $attrs[$key] : null;
            if ($newvalue === "true") $newvalue = true;
            if ($newvalue === "false") $newvalue = false;            
            if(key_exists($key, $this->_options)):
                $this->_options[$key] = $newvalue;
            else:
                $this->$key = $newvalue;
            endif;
        }  

        $props = get_object_vars($this);      

        $oRDP_WIKI_EMBED_CONTENT = new RDP_WIKI_EMBED_CONTENT($props);
        $sHTML = sprintf('<div id="rdp-we-main" data-resource="%s">', esc_attr($attrs['url']) );
        $sHTML .= $oRDP_WIKI_EMBED_CONTENT->fetch();
        $sHTML .= '</div><!-- #rdp-we-main -->';
        
        if(!has_action('wp_footer', array(&$this,'renderTOCMenu'))){
            add_action('wp_footer', array(&$this,'renderTOCMenu'));
        }         
        
        // call enqueueScripts to make sure shortcode atts take affect
        $this->enqueueScripts();
        
        return $sHTML;
    }//shortcode  
    
    
    public function renderTOCMenu(){
        $sInlineHTML = '';
        $contentPieces = array();
        $collection = array();
        $sKey  = get_post_meta(get_the_ID(), '_rdp-ppe-cache-key', true);
        $contentPieces = get_option( $sKey );
        if(empty($contentPieces)):
            $collection = get_post_meta(get_the_ID(), '_wiki_book_metadata',true);
        endif;
        
        if(empty($contentPieces) && empty($collection))return;        
        if(!wp_script_is('jquery-colorbox'))wp_enqueue_script( 'jquery-colorbox', plugins_url( 'js/jquery.colorbox.min.js',__FILE__),array("jquery"), "1.3.20.2", true );   
        wp_enqueue_script(
                'rdp_we_toc_popup', 
                plugins_url( 'js/script.toc-popup.js',__FILE__),
                array("jquery"), 
                $this->_version, 
                true ); 
        if(!wp_style_is('jquery-colorbox'))wp_enqueue_style( 'jquery-colorbox', plugins_url( 'css/colorbox.css',__FILE__),false, "1.3.20.2", 'screen');        
        $sInlineHTML .= "<div id='rdp_we_toc_inline_content_wrapper' style='display:none'><div id='rdp_we_toc_inline_content'>";
        $sInlineHTML .= '<h2>Table of Contents:</h2>';
        if(!empty($contentPieces)){
            $sInlineHTML .= $contentPieces['toc'];
        }elseif(!empty($collection) && !empty($collection['items'])){
            $tocHTML = '<ul class="rdp-wbb-outline">';
            foreach ($collection['items'] as $item) {
                
                $tocHTML .= '<li class="' . $item['type'] . '">';
                switch ($item['type']) {
                    case 'chapter':
                        $tocHTML .= 'Chapter: ' . esc_html($item['title']);

                        break;

                    default:
                        $sURL = esc_attr($item['url']);
                        $sTitle = esc_attr($item['title']);
                        $sText = esc_html($item['title']);
                        $sKey = esc_attr($item['key']);
                        
                        if(empty($sURL)){
                            $tocHTML .= $sTitle;
                        }else{
                            $tocHTML .= sprintf('<a href="%s" class="external" title="%s" data-guid="%s">%s</a>',$sURL,$sTitle,$sKey,$sText);
                        }

                        break;
                }
                
                $tocHTML .= '</li>';
                
            }
            
            $tocHTML .= '</ul><!-- .rdp-wbb-outline -->';                
            $sInlineHTML .= $tocHTML;
        }

        $sInlineHTML .= "</div><!-- #rdp_we_inline_content --></div>";
        echo $sInlineHTML;
       
    }//renderTOCMenu 
    
    /**
     * This function gets called once inside RDP_WIKI_EMBED_PLUGIN->define_front_hooks(),
     * and might get called a second time in $this->shortcode(), above. This is
     * to ensure that any overriding shortcode atts are honored.
     * 
     * @return void
     */
    public function enqueueScripts() {
        // global wiki content replace
        // clear enqueued script to make sure any overriding shortcode atts take affect
        if (wp_script_is('rdp-we-wcr')) {
            wp_deregister_script( 'rdp-we-wcr' );
        }
        
        global $wp_scripts;
        
        $fOverwrite = ($this->_options['wiki_links'] === 'overwrite');
        $fGlobalCR = (isset($this->_options['global_content_replace']))? intval($this->_options['global_content_replace']) : 0;
        $text_string = empty($this->_options['whitelist'])? '' : $this->_options['whitelist'];
        if($fOverwrite && $fGlobalCR && !empty($text_string)){
            wp_enqueue_script( 'rdp-we-wcr', plugins_url( 'js/script.wcr.js' , __FILE__ ), array( 'jquery','jquery-query','jquery-url' ), '1.0', TRUE);
            $str = preg_replace('#\s+#',',',trim($text_string));
            $params = array(
                'domains' => $str
            );
            wp_localize_script( 'rdp-we-wcr', 'rdp_wcr', $params ); 
        }         
        
        do_action('rdp_we_scripts_enqueued');        
    }//enqueueScripts
    
    public function enqueueStyles() {
        if(wp_style_is('rdp-we-style-common'))return;
        if(!wp_script_is( 'jquery-url', 'registered' )){
            wp_register_script( 'jquery-url', plugins_url( 'js/url.min.js' , __FILE__ ), array( 'jquery','jquery-query' ), '1.0', TRUE );
            wp_enqueue_script( 'jquery-url');
        }          

        wp_enqueue_style(
                'rdp-mediawiki-style', 
                plugins_url( 'css/wiki-embed.css' , __FILE__ ), 
                null, 
                $this->_version);
        
        wp_enqueue_style(
                'rdp-we-style-common', 
                plugins_url( 'css/style.css' , __FILE__ ), 
                array('rdp-mediawiki-style'), 
                $this->_version);
        
        do_action('rdp_we_styles_enqueued');
    }//enqueueStyles
    
    public function contentFilter($content) {
        if(empty($this->_resource))return $content;
        $attrs = self::parseShortcodeAttrs($content);
        $attrs['url'] = $this->_resource;             
        //remove_all_filters( 'the_content' );
        
        /* Return the content. */
        return $this->shortcode($attrs);        
    }//contentFilter
    
    public function handleTemplateSelection($template){
        if(empty($this->_resource))return $template; 
        $post_types = array('post','page');
        if(!is_singular($post_types)) return $template;
        $post = get_queried_object();
        $attrs = self::parseShortcodeAttrs($post->post_content); 
        $defaults = RDP_WIKI_EMBED_PLUGIN::default_settings();
        $sRequestedTemplate = (!empty($attrs['global_content_replace_template']))? $attrs['global_content_replace_template'] : $defaults['global_content_replace_template'];        
        if(empty($sRequestedTemplate) || $sRequestedTemplate == $defaults['global_content_replace_template'])return $template;
        $new_template = locate_template( array( $sRequestedTemplate ) );
        if ( '' != $new_template ) {
               $template = $new_template ;
        }

        return $template;        
    }  
    
    private static function parseShortcodeAttrs($content){
        $tagnames[] = 'rdp-wiki-embed';
        $pattern = get_shortcode_regex( $tagnames );
        preg_match("/$pattern/",$content,$matches);
        $attrs = array();
        if(!empty($matches[3])){
            $Content = preg_replace("/&#?[a-z0-9]{2,8};/i","",$matches[3]); 
            $attrs = shortcode_parse_atts( $Content );            
        }  
        return $attrs;
    }
} //RDP_WIKI_EMBED


/*  EOF  */