<?php
/* -----------------------------------------------------------
 * ANIME PICKS 2
 * Copyright 2012
 * 
 * File: functions.php
 * Desc: Core functions supporting WordPress
 * Last Author: Sheru
 * Original Author: Sheru
 *
 * Notes:
 *
 * -----------------------------------------------------------
 */

/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
    - enqeueing scripts & styles
    - theme support functions
    - custom menu output & fallbacks
    - related post function
    - page-navi function
    - removing <p> from around images
    - customizing the post excerpt
    - custom google+ integration
    - adding custom fields to user profiles
*/
require_once('library/version.php');                    // ap version information
require_once('library/detectmobile/detectmobile.php');  // browser detection library
require_once('library/bones.php');                      // if you remove this, bones will break
require_once('library/custom-post-type.php');           // you can disable this if you like
require_once('library/admin.php');                      // this comes turned off by default
require_once('library/log.php');                        // error logging to errors.css


/* AP SETUP & CONFIGURATION
 * 
 */
function konnichiwa() {
    
    /* VARS
     * 
     */
    GLOBAL $animePicksVersion;
    
    /* DETECT PLATFORM
     * We can add future platforms and detect other properties in the future by editing
     * library/detectmobile/detectmobile.php
     */
    $detect = new Mobile_Detect();
    $isMobile = $detect->isMobile($userAgent, array());
    $isTablet = $detect->isTablet($userAgent, array());
    
    /* AP RESPONSIVE & MOBILE STYLES
     * AP has two modes: 'responsive' (tablets & desktop) and 'mobile' (all phones)
     *
     * We could do this as Media Queries in CSS, however that requires a lot of CSS to be delivered to
     * the browsers that'll never be used. So instead, we're going to do it here server-side and only
     * send the styles needed, keeping the site skinny as possible for mobile phones...
     * 
     */
    if ( $isMobile ) {
        if ( $isTablet ) {
            $apResponsive = true; // tablet, display full-fat responsive version
        } else {
            $apResponsive = false; // mobile, display mobile app version
        }
    } else {
        $apResponsive = true; // desktop, display full-fat responsive version
    }
    if ( $apResponsive ) {
        //wp_register_style( 'animepicks-responsive', get_template_directory_uri() . '/library/less/style.css', array(), $animePicksVersion, 'all' );
        //wp_enqueue_style( 'animepicks-responsive' );
    } else {
        //wp_register_style( 'animepicks-mobile', get_template_directory_uri() . '/library/less/style.css', array(), $animePicksVersion, 'all' );
        //wp_enqueue_style( 'animepicks-mobile' );
    }
    
    /* ADMIN BAR
     * We dont want to display the Admin bar on magazine pages as it'll conflict with our mega-menu,
     * so lets remove it...
     * 
     */
    if ( !is_admin() ) {
        add_filter( 'show_admin_bar', '__return_false' );
    }

}

/* AP STARTUP
 * 
 */
add_action('after_setup_theme','konnichiwa');

/* AP CATEGORIES
 * 
 */
function tableOfContents() {
    $tocEntries = "";
    $categories = get_categories();
    foreach ($categories as $category) {
        $title = $category       -> cat_name;
        $slug = $category        -> category_nicename;
        $desc = $category        -> category_description;
        $id =                    get_cat_ID( $title );
        $link =                  get_category_link( $id );
        $tocEntries = $tocEntries . "<li>" .
                                    "<a href='" .$link. "'><!--<img src='" . get_bloginfo("template_directory") . "/images/categories/" . $slug . ".jpg' alt='" .$title. "' />--></a>" .
                                    "<div class='toc_title'><a href='" .$link. "'>" .$title. "</a></div>" .
                                    "</li>";
    }
    $toc = "<ul>" . $tocEntries . "</ul>";
    $tocToggle = "<button id='btnToggleTOC'>Show</button>";
    print "<nav id='tableOfContents'>" . $toc . $tocToggle . "</div>";
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => 'Sidebar 1',
        'description' => 'The first (primary) sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
        'id' => 'sidebar2',
        'name' => 'Sidebar 2',
        'description' => 'The second (secondary) sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
        
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
        <article id="comment-<?php comment_ID(); ?>" class="clearfix">
            <header class="comment-author vcard">
                <?php /*
                    this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
                    echo get_avatar($comment,$size='32',$default='<path_to_url>' );
                */ ?>
                <!-- custom gravatar call -->
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>&s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
                <!-- end custom gravatar call -->
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                <?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                   <div class="alert info">
                      <p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
                  </div>
            <?php endif; ?>
            <section class="comment_content clearfix">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!


?>