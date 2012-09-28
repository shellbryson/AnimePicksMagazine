<?php
/* -----------------------------------------------------------
 * ANIME PICKS 2
 * Copyright 2012
 * 
 * File: version.php
 * Desc: maintains version information about platform
 * Last Author: Sheru
 * Original Author: Sheru
 *
 * Notes:
 *
 *  Version example
 *
 *      2.0.0.0
 *      a b c d
 *
 *          a - generation
 *          b - feature set
 *          c - minor feature set
 *          d - fixes, refactoring, build
 *
 *      CORE   - Changes to core functionality
 *      PAGE   - Page specific changes (named)
 *      ADD    - New functionality
 *      FIX    - Specific bug fix
 *
 *  When updating build numbers & dates, remember to change
 *  $animePicksVersion & $animePicksVersionDate
 *
 * -----------------------------------------------------------
 *  
 * File targets:
 *      No more than 25 files before content
 *      No more than 300kb before content
 *      No more than 1.5 seconds to render
 *
 * 2012/08/17 - 8 CSS, 4 fonts, 8 scripts
 *
 * -----------------------------------------------------------
 */

$animePicksVersion = "2.0.0.37";
$animePicksVersionDate = "2012/09/28";

/*
2.0.0.37        2012/09/28         ALPHA
 1) CORE: Moved into GIT for version control

2.0.0.36        2012/09/27         ALPHA
 1) CORE: Some significant re-jigging for a week long big-push to get a rough demo working
 2) CORE: Added 'bento.php' for handling special Bento Box page

2.0.0.34        2012/08/17         ALPHA
 1) ADD: Mobile Detection tool: /library/detectmobile/detectmobile.php
 2) CORE: Detect if mobile phone: serve 'animepicks-mobile.css' (iPhone etc) or 'animepicks-responsive.css' (desktop & iPad)
          These styles share common elements via less.css.
 3) CORE: Remove 'generic' styles (they're still there in ap-generic.less)
 4) CORE: Created ap-fonts.less, compiles into ap-generic.less (which is shared between platform files).
 
2.0.0.30        2012/08/16         ALPHA
 1) CORE: Replaced theme with Bones base theme to make construction easier
 2) CORE: Re-integrated version.php, log.php etc

2.0.0.28        2012/08/15         ALPHA
 1) CORE: Cache util: refactor
 2) CORE: Cache util: check that localStore available
 3) CORE: Cache util: added _meta keys
 4) CORE: Cache util: cached items now version controlled, checked against $animePicksVersion

2.0.0.24        2012/08/10         ALPHA
 1) CORE: Added error logging (log.php) that writes PHP errors to 'errors.csv'
 2) CORE: Added debug.php for displaying PHP errors... not quite working yet
 3) CORE: Renamed template to be version agnostic ("AnimePicksMagazine")
 4) CORE: Created new folder structure to keep AP styles, fonts, scripts & images isolated from messy Bootstrap structure
 5) ADD:  Icon Fonts, via http://fortawesome.github.com/Font-Awesome/
 6) CORE: Upgraded jQuery to 1.8.0 (was 1.7.1)
 7) CORE: Removed CDN, complicates matters during development
 8) CORE: Some experimentation with merging of CSS files. Clearly too much! 109kb. Will have to hand-spin styles for AP,
          creating our own verison of Bootstrap / Responsive.
 9) FIXED: Version missing from header output
10) FIXED: Version not being appended to qs for loaded CSS files

2.0.0.14        2012/08/09         ALPHA
 1) CORE: Global version ow being passed to animepicks.js.php
 2) CORE: Added page resize handler
 3) CORE: Added tracking for screen size - animePicksConfig.narrowScreen: true|false
 4) CORE: Removed version stuff, not needed
 5) CORE: Changed this version file to *not* hold version history as $var, eating up precious memory, as it will get quite large
 6) CORE: ** Server Upgraded ** PHP Memory was 30Mb, now 80Mb. 15 Parallel Processes. Unlimited space.
 7) CORE: Added a secret message
 8) FIX:  Fixed issue with resize scripts firing repeatedly. Now only fires once going above & below animePicksConfig.narrowScreenWidth
 9) FIX:  animepicksCache now correctly sets & returns values from localStorage, so caching can now be implemented
 
2.0.0.5         2012/08/03         ALPHA
 1) CORE: Added global versioning
 2) CORE: Added PHP processed core javascript (animepicks.js.php)
 3) CORE: Google CDN version of jQuery 1.7.2
 4) CORE: Removal of on-the-fly Less compilation in favour for pre-processed CSS (with Less source)
 5) CORE: Header information added to a number of core files
 
VERSIONSTRING;
*/
?>