<?php
/* -----------------------------------------------------------
 * ANIME PICKS 2
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
    cacheEnabled: true,         // - We assume that we can cache, at least until we test for localStorage...
    mobile: <?php echo $mobile ?>
}

var toc;
var tocToggle;
var tocList;

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
        if ( key ) {
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

/*
RUN
----------------------------------------------------------- */
$( function(){

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
        animePick.cache = new animepicksCache();
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
        
});

/*
TRACK SCREEN DIMENSIONS
----------------------------------------------------------- */
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
