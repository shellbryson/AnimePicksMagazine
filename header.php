<?php
/* -----------------------------------------------------------
 * ANIME PICKS 2
 * Copyright 2012
 * 
 * File: header.php
 * Desc: Common WordPress header
 * Last Author: Sheru
 * Original Author: Sheru
 *
 * Notes:
 *
 * -----------------------------------------------------------
 */
 GLOBAL $animePicksVersion;
 GLOBAL $animePicksVersionDate;
?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    
    <head>
        <!--
            ANIME PICKS, the Anime Magazine
                Editor: Gina Lucia.
                Developed by: Sheru
                Content by the Anime Picks crew & friends
                Copyright 2010-2013
            
            Version <?php echo $animePicksVersion . ", " . $animePicksVersionDate; ?>
            
        -->
        <meta charset="utf-8">
        
        <title><?php wp_title(''); ?></title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="True">
        
        <!-- do we need to change this depending on target??? -->
        <!--<meta name="MobileOptimized" content="320">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700'>
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Oxygen'>
            
        <?php wp_head(); ?>
            
        <!-- drop Google Analytics Here -->
        <!-- end analytics -->
        

        
    </head>
    
    <body <?php body_class(); ?>>
    
        <div id="container">
            
            <header class="header" role="banner">
            
                <div id="inner-header" class="wrap clearfix">
                    
                    <!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
                    <p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
                    <div class="_base _responsive">base +</div>
                    <div class="_1240up _responsive">1240up</div>
                    <div class="_1030up _responsive">1030up</div>
                    <div class="_768up _responsive">768up</div>
                    <div class="_481up _responsive">481up</div>
                    
                    <!-- if you'd like to use the site description you can un-comment it below -->
                    <?php // bloginfo('description'); ?>
                    
                    
                    <nav role="navigation">
                        <!--
                        <?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
                        -->
                    </nav>
                
                </div> <!-- end #inner-header -->
            
            </header> <!-- end header -->
