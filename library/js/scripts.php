<?php
/* -----------------------------------------------------------
 * ANIME PICKS
 * Copyright 2012
 * 
 * File: animepicks.php 
 * Desc: processed javascript for AP UI
 * Last Author: Sheru
 * Original Author: Sheru
 *
 * Notes:
 *
 *  Core script for managing pages & content. JS seasoned with
 *  PHP for dynamic server stuff. Version passed in as queryString,
 *  so each time the build changes, this script becomes un-cached.
 *  
 * -----------------------------------------------------------
 */

/*
PHP INIT
----------------------------------------------------------- */
header('Content-type: text/javascript');
$version = $_GET["apversion"];
$mobile = $_GET["mobile"];
?>

/*
ANIMEPICKS INSTANCE CONTAINER
----------------------------------------------------------- */
var animePicks = { }

/*
CONFIGURATION
----------------------------------------------------------- */
var animePicksConfig = {
    version: "<?php echo $version ?>",
    secretMessage: "[Anna May] Konnichiwa! Welcome to Anime Picks! But why are you reading this console!? My magazine is more interesting and fun! Well seeing as you are here, let us know for a little prize! [/Anna May]",
    width: window.innerWidth,   // - Initial value (reset by window resize)
    height: window.innerHeight, // - Initial value (reset by window resize)
    narrowScreenWidth: 481,     // - Width below which mobile app mode kicks in. Guide: iPhone 3G width = 320px
    narrowScreen: false,        // - Checked on screen resize
    cacheEnabled: false,        // - We assume that we can cache, at least until we test for localStorage...
    mobile: <?php echo $mobile ?>
}

var toc;
var tocToggle;
var tocList;

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        }
        return this;
    }
}

// as the page loads, call these scripts
//$( function() {

jQuery(document).ready(function($) {
    
    //dm(animePicksConfig);
    
    // Ref cache
    toc = $("#tableOfContents"); // toc container
    tocToggle = $("#btnToggleTOC"); // toc button
    tocList = toc.find( "ul" ); // toc ul

    // Welcome
    dm( "VERSION " + animePicksConfig.version + "\n\n");
    dm( animePicksConfig.secretMessage );
    
    // Init
    updateDimensions();
    
    // Create & populate cache
    if ( animePicksConfig.cacheEnabled ) {
        animePicks.cache = new animepicksCache();
        animePicks.cache.set( { key: "version", value: animePicksConfig.version } );
        var versionMessage = animePicks.cache.get("version");
        dm( versionMessage.value );
    }
    
    // Setup screen resize handler
    $( window ).resize( function(){
        updateDimensions();
    })
    
    /*
    EVENTS
    ----------------------------------------------------------- */
    tocToggle.bind("click", function(){
        // show or hide the category selector (only applies on mobile, narrow)
        //if ( animePicksConfig.narrowScreen ) {
            tocList.show();
        //}
        return false;
    })

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it, so be sure to research and find the one
    that works for you best.
    */
    
    /* getting viewport width */
    var responsive_viewport = $(window).width();
    
    /* if is below 481px */
    if (responsive_viewport < 481) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport > 481) {
        
    } /* end larger than 481px */
    
    /* if is above or equal to 768px */
    if (responsive_viewport >= 768) {
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {
        
    }
 
}); /* end of as page load scripts */

/*
FEATURE DETECT
----------------------------------------------------------- */
var storage = (function() {
    var uid = new Date,
        result;
    try {
        localStorage.setItem(uid, uid);
        result = localStorage.getItem(uid) == uid;
        localStorage.removeItem(uid);
        return result && localStorage;
    } catch(e) {}
}());
if (!storage) {
    animePicksConfig.cacheEnabled = false;
}

/*
CACHING
----------------------------------------------------------- */
/*
 * Attempts to use localStorage to save some assets locally for improved performance
 * Not all browsers have localStorage support yet (IE, looking at u)
 */

// Cache object
function animepicksCache() {
    return true;
}

animepicksCache.prototype = {

    /* WRITE TO CACHE
     * Check key doesn't already exist. Check key's meta version. If
     * key doesn't exist or meta version different, update/create.
     *
     * Params:
     *
     *  key   - the key to set
     *  value - what to set the value to
     */
    set: function( params ) {
        var key = params.key;
        var value = params.value;
        if ( key && value ) {
            var keyValue = localStorage.getItem( key );
            var keyMeta = '{ "version":"' + animePicksConfig.version + '" }';
            if ( !keyValue ) { // key doesn't exist
                localStorage.setItem( key, value );
                localStorage.setItem( key + '_meta', keyMeta );
            } else { // key exists
                var oldKey = localStorage.getItem( key + "_meta" ), // get meta for this key
                    keyCheck = $.parseJSON( oldKey ),               // get current version number of key
                    keyCurrentVersion = keyCheck.version;
                if ( keyCurrentVersion != animePicksConfig.version ) {     // key is out of date, overwrite it
                    localStorage.setItem( key, value );
                    localStorage.setItem( key + "_meta", keyMeta );
                }
            }
        }
    },

    /* GET FROM CACHE
     * Get key from localStorage, get key's meta from localStorage, glue
     * together into single object
     */
    get: function( key ) {
        var keyValue, keyMeta, keyObj;
        if ( key ) {
            keyValue = localStorage.getItem( key );
            keyMeta  = localStorage.getItem( key + "_meta");
            keyObj = {
                key: key,
                value: keyValue,
                meta: $.parseJSON( keyMeta )
            }
        }
        return keyObj;
    },

    /* CLEAR CACHE
     * Clear all cached data
     */
    clear: function() {
        localStorage.clear();
    }
}

/*
ANIMEPICKS UTILS
----------------------------------------------------------- */

// Debug messages
function dm( message ) {
    if ( message ) {
        var msg;
        if ( typeof message == "object") {
            msg = message;
        } else {
            msg = "AP: " + message;
        }
        try {
            console.log( msg );
        } catch (e) { // couldn't find a console, so we'll dump message to a display <div />
            $("#debug").hide().append( "<p>" + msg + "</p>" ).fadeIn(250);
        }
    }
}
// Screen tracker
function smallScreen(){
    tocList.hide();
    tocToggle.show();
}
function bigScreen(){
    tocList.show();
    tocToggle.hide();
}

// Called on page render & resize
function updateDimensions() {
    animePicksConfig.width = window.innerWidth;
    animePicksConfig.height = window.innerHeight;
    if ( animePicksConfig.width <= animePicksConfig.narrowScreenWidth ) {
        if ( animePicksConfig.narrowScreen != true ) {
            smallScreen();
            animePicksConfig.narrowScreen = true;
        }
    } else {
        if ( animePicksConfig.narrowScreen != false ) {
            bigScreen();
            animePicksConfig.narrowScreen = false;
        }
    }
}

/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
    // This fix addresses an iOS bug, so return early if the UA claims it's something else.
    if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
        x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
        aig = e.accelerationIncludingGravity;
        x = Math.abs( aig.x );
        y = Math.abs( aig.y );
        z = Math.abs( aig.z );
        // If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
            if( enabled ){ disableZoom(); } }
        else if( !enabled ){ restoreZoom(); } }
    w.addEventListener( "orientationchange", restoreZoom, false );
    w.addEventListener( "devicemotion", checkTilt, false );
})( this );
