<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://alexeyvolkov.com/
 * @since      0.6
 *
 * @package    Simple_Youtube_Gdpr
 * @subpackage Simple_Youtube_Gdpr/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Simple_Youtube_Gdpr
 * @subpackage Simple_Youtube_Gdpr/public
 * @author     Alexey Volkov <alexey.a.volkov@pm.me>
 */
class Simple_Youtube_Gdpr_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    0.6
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    0.6
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     *
     * @since    0.6
     *
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    0.6
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Simple_Youtube_Gdpr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Simple_Youtube_Gdpr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/simple-youtube-gdpr-public.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    0.6
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Simple_Youtube_Gdpr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Simple_Youtube_Gdpr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-youtube-gdpr-public.js' );
    }
    
    /**
     * @param $cache
     * @param $url
     * @param $attr
     * @param $post_ID
     *
     * @return string
     */
    public function syg_embed_oembed_html(
        $cache,
        $url,
        $attr,
        $post_ID
    )
    {
        $type = 'nothing';
        if ( false !== strpos( $url, "youtube.com" ) || false !== strpos( $url, "://youtu.be" ) ) {
            $type = 'youtube';
        }
        
        if ( $type == 'nothing' ) {
            // nothing found
            return $cache;
        } else {
            return $this->getHtml( $cache, $url, $type );
        }
    
    }
    
    /**
     * Return HTML code of preview block
     *
     * @param $url (required) The URL to retrieve embedding information for.
     * @param string $type (optional) Provider code
     *
     * @return string
     */
    private function getHtml( $cache, $url, $type = 'youtube' )
    {
        // vars
        $type = filter_var( $type, FILTER_SANITIZE_STRING );
        $url = filter_var( $url, FILTER_SANITIZE_URL );
        $cache = str_replace( 'src', 'srcblockloading', $cache );
        // dont load scripts! You are <template>!!!!
        $api_endpoint = array(
            'youtube' => 'http://www.youtube.com/oembed?url=',
        );
        // Download JSON
        $json_content = file_get_contents( filter_var( $api_endpoint[$type] . $url, FILTER_SANITIZE_URL ) );
        if ( !$json_content ) {
            return '';
        }
        // Decode JSON
        $json_content = json_decode( $json_content, true );
        /**
         * Response parameters
         *
         * @var $title (optional) A text title, describing the resource.
         * @var $provider_name (optional) The url of the resource provider.
         * @var $thumbnail_url (optional) A URL to a thumbnail image representing the resource.
         * @var $attr_more (optional) Additional attributes.
         * @var $provider_privacy_url (required) A URL to a privacy policy.
         */
        $title = ( isset( $json_content['title'] ) ? filter_var( $json_content['title'], FILTER_SANITIZE_STRING ) : '' );
        $provider_name = filter_var( $json_content['provider_name'], FILTER_SANITIZE_STRING );
        $thumbnail_url = ( isset( $json_content['thumbnail_url'] ) ? $this->get_thumbnail_url( filter_var( $json_content['thumbnail_url'], FILTER_SANITIZE_URL ) ) : '' );
        $attr_more = array(
            'height' => '',
            'width'  => '',
            'html'   => '',
        );
        
        if ( isset( $json_content['thumbnail_width'] ) && filter_var( $json_content['thumbnail_width'], FILTER_SANITIZE_NUMBER_INT ) > 0 ) {
            $attr_more['html'] .= sprintf( 'width:%dpx;', filter_var( $json_content['thumbnail_width'], FILTER_SANITIZE_NUMBER_INT ) );
            $attr_more['width'] = filter_var( $json_content['thumbnail_width'], FILTER_SANITIZE_NUMBER_INT );
        } else {
            $attr_more['html'] .= sprintf( 'width:%dpx;', filter_var( $json_content['width'], FILTER_SANITIZE_NUMBER_INT ) );
            $attr_more['width'] = filter_var( $json_content['width'], FILTER_SANITIZE_NUMBER_INT );
        }
        
        
        if ( isset( $json_content['thumbnail_height'] ) && filter_var( $json_content['thumbnail_height'], FILTER_SANITIZE_NUMBER_INT ) > 0 ) {
            $attr_more['html'] .= sprintf( 'height:%dpx;', filter_var( $json_content['thumbnail_height'], FILTER_SANITIZE_NUMBER_INT ) );
            $attr_more['height'] = filter_var( $json_content['thumbnail_height'], FILTER_SANITIZE_NUMBER_INT );
        } else {
            $attr_more['html'] .= sprintf( 'height:%dpx;', filter_var( $json_content['height'], FILTER_SANITIZE_NUMBER_INT ) );
            $attr_more['height'] = filter_var( $json_content['height'], FILTER_SANITIZE_NUMBER_INT );
        }
        
        $provider_privacy_url = array(
            'youtube' => esc_url( __( 'https://policies.google.com/privacy?hl=en', 'simple-youtube-gdpr' ) ),
        );
        $template = '<figure class="syg__box syg__box-' . $type . '" style="background-image: url(\'' . $thumbnail_url . '\');' . $attr_more['html'] . '" data-syg-url="' . $api_endpoint[$type] . $url . '" aria-live="assertive">';
        $template .= '<button class="syg__box__text__btn" title="' . sprintf( esc_html__( 'Show %s content: %s', 'simple-youtube-gdpr' ), $provider_name, $title ) . '" aria-label="' . sprintf( esc_html__( 'Show %s content: %s', 'simple-youtube-gdpr' ), $provider_name, $title ) . '">' . sprintf( esc_html__( 'Show %s content', 'simple-youtube-gdpr' ), $provider_name ) . '</button>';
        $attr_more['html'] = '';
        
        if ( $attr_more['width'] > $attr_more['height'] ) {
            // width > height
            $attr_more['html'] .= sprintf( 'height:%dpx;', $attr_more['height'] );
        } else {
            // height > width
            $attr_more['html'] .= sprintf( 'width:%dpx;', $attr_more['width'] );
        }
        
        $template .= '<img src="' . $thumbnail_url . '" alt="' . esc_html( $title ) . '" style="' . $attr_more['html'] . '">';
        $template .= '<figcaption class="syg__box__text">' . sprintf(
            __( 'By showing the %s content you accept <a href=" % s" target="_blank" rel="nofollow noreferrer noopener" referrerpolicy="no - referrer" title=" % s">its privacy policy</a>.', 'simple-youtube-gdpr' ),
            $provider_name,
            $provider_privacy_url[$type],
            sprintf( esc_html__( '%s Privacy Policy page (opens in a new window)', 'simple-youtube-gdpr' ), $provider_name )
        ) . '</figcaption > ';
        //.syg__box__text
        $template .= '<template class="syg__box__html" data-type="' . $type . '">' . $cache . '</template>';
        $template .= '</figure > ';
        // .syg__box
        return $template;
    }
    
    /**
     * Get URL of local image
     *
     * @param $url string Image form Web
     *
     * @return string URL of local Image
     */
    private function get_thumbnail_url( $url )
    {
        if ( '' === trim( $url ) ) {
            return false;
        }
        $url = filter_var( $url, FILTER_SANITIZE_URL );
        // https://live.stkr.com/3898/1c26_c.jpg?sfsf=sdfsdf -> 1c26_c.jpg
        $image_name = md5( $url ) . '.jpg';
        // Make it MD5 -> so all (_!@#$%^)(*&) symbols are sanitized and each one is unique
        $upload_dir = wp_upload_dir();
        // wp_upload_dir()[baseurl] => http://example.com/content/uploads
        
        if ( !file_exists( $upload_dir['basedir'] . '/simple-youtube-gdpr-thumbnails/' . $image_name ) ) {
            $image_data = file_get_contents( $url );
            // download image from URL
            $upload_dir['path'] = $upload_dir['basedir'] . '/simple-youtube-gdpr-thumbnails/';
            // Set upload folder
            // Check folder permission and define file location
            
            if ( wp_mkdir_p( $upload_dir['path'] ) ) {
                $file = $upload_dir['path'] . '/' . $image_name;
            } else {
                $file = $upload_dir['basedir'] . '/' . $image_name;
            }
            
            // Create the image  file on the server
            if ( !file_put_contents( $file, $image_data ) ) {
                return false;
            }
        }
        
        return $upload_dir['baseurl'] . '/simple-youtube-gdpr-thumbnails/' . $image_name;
        // return local url
    }
    
    /**
     * @param $links
     *
     * @return array
     */
    public function add_action_links( $links )
    {
        $mylinks = array( '<a href="' . syg_fs()->get_upgrade_url() . '" title="' . esc_html( __( 'Upgrade plan', 'simple - youtube - gdpr' ) ) . '"><strong style="display: inline;">' . esc_html( __( 'Block Vimeo and more!', 'simple-youtube-gdpr' ) ) . '</strong></a>' );
        return array_merge( $mylinks, $links );
    }
    
    /**
     * Plugin Action links
     *
     * @param $links
     * @param $file
     *
     * @return array
     */
    public function add_plugin_row_meta( $links, $file )
    {
        
        if ( strpos( $file, 'simple-youtube-gdpr.php' ) !== false ) {
            $new_links = array(
                'donate' => '<a href="https://money.yandex.ru/to/41001417963743" target="_blank" title="' . esc_html( __( 'Payment in RUB - Russian Rubles', 'simple-youtube-gdpr' ) ) . '">&hearts; ' . esc_html( __( 'Donate', 'simple-youtube-gdpr' ) ) . '</a>',
            );
            $links = array_merge( $links, $new_links );
        }
        
        return $links;
    }

}