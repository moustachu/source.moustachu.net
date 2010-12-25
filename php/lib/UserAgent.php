<?php
    /**
    * o------------------------------------------------------------------------------o
    * | This package is licensed under the Phpguru license. A quick summary is       |
    * | that for commercial use, there is a small one-time licensing fee to pay. For |
    * | registered charities and educational institutes there is a reduced license   |
    * | fee available. You can read more  at:                                        |
    * |                                                                              |
    * |                  http://www.phpguru.org/static/license.html                  |
    * o------------------------------------------------------------------------------o
    */

    /**
    * UserAgent detection. Based on the js ultimate browser detection thingy.
    * Email richardh@phpguru.org to send suggestions or improvements.
    *
    * Advantages:
    *
    * o Its quick
    * o It doesn't pollute the global namespace
    *
    * One example usage is to only output a simple version of your website
    * if it's a bot. Why waste your bandwidth? Its still advisable to output some
    * sort of site, otherwise things like news aggregators won't work.
    */

    function GetUserAgent($ua = null)
    {
        /**
        * Default to the user agent that the browser sends
        */
        if (is_null($ua)) {
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }
        
        $b = array();

        /**
        * Major and minor version numbers
        */
        $b['is_major'] = intval(substr($ua, strpos($ua, 'Mozilla/') + 8));
        $b['is_minor'] = substr($ua, strpos($ua, 'Mozilla/') + 8);
        $b['is_minor'] = (int)substr($b['is_minor'], strpos($b['is_minor'], '.') + 1);;

        /**
        * Type of browser
        */
        $b['is_safari'] = strpos($ua, ' Safari/') !== false && strpos($ua, 'Chrome') === false;
        $b['is_chrome'] = strpos($ua, ' Chrome/') !== false;
        $b['is_ff']     = strpos($ua, 'Firefox') !== false;
        $b['is_ie']     = (strpos($ua, 'MSIE')     !== false && strpos($ua, 'Opera') === false);
        $b['is_opera']  = strpos($ua, 'Opera')     !== false;
        $b['is_nn']     = (strpos($ua, 'Mozilla')  !== false && 
                          strpos(strtolower($ua), 'spoofer')  === false &&
                          strpos(strtolower($ua), 'webtv')   === false && 
                          strpos(strtolower($ua), 'hotjava') === false &&
                          $b['is_opera'] === false &&
                          $b['is_ie']    === false &&
                          $b['is_ff']    === false &&
                          $b['is_chrome'] === false &&
                          $b['is_safari'] === false);
        $b['is_konq']  = strpos($ua, 'Konqueror') !== false;

        /**
        * Operating system
        */
        $b['is_win'] = strpos($ua, 'Win') !== false;
        $b['is_mac'] = strpos($ua, 'Mac') !== false;
        $b['is_nix'] = strpos($ua, 'X11') !== false;

        /**
        * Internet Ekplorer
        */
        if ($b['is_ie'] AND !$b['is_opera']) {
            $b['is_ie4']        = strpos($ua, 'MSIE 4.') !== false;
            $b['is_ie5']        = strpos($ua, 'MSIE 5.') !== false;
            $b['is_ie5_5']      = strpos($ua, 'MSIE 5.5') !== false;
            $b['is_ie6']        = strpos($ua, 'MSIE 6.') !== false;
            $b['is_ie7']        = (strpos($ua, 'MSIE 7.') !== false && strpos($ua, 'Trident') === false); // IE7
            $b['is_ie7_compat'] = (strpos($ua, 'MSIE 7.') !== false && strpos($ua, 'Trident') !== false);  // IE8 in IE7 compatibility mode
            $b['is_ie8']        = $b['is_ie7_compat'] || strpos($ua, 'MSIE 8.') !== false;                                       // IE8
            
            // 64bit Windows
            $b['is_x64'] = strpos($ua, 'x64') !== false;

        /**
        * Firefox
        */
        } elseif ($b['is_ff']) {
            $b['is_ff1'] = strpos($ua, 'Firefox/1') !== false;
            $b['is_ff2'] = strpos($ua, 'Firefox/2') !== false;
            $b['is_ff3'] = (strpos($ua, 'Firefox/3') !== false AND strpos($ua, 'Firefox/3.5') === false);
            $b['is_ff35'] = strpos($ua, 'Firefox/3.5') !== false;

        /**
        * Netscape Navigator
        */
        } elseif ($b['is_nn']) {
            $b['is_nn2']   = $b['is_major'] === 2;
            $b['is_nn2up'] = $b['is_major'] >= 2;
            $b['is_nn3']   = $b['is_nn2up'] && $b['is_major'] === 3;
            $b['is_nn3up'] = $b['is_nn2up'] && $b['is_major'] >= 3;
            $b['is_nn4']   = $b['is_nn3up'] && $b['is_major'] === 4;
            $b['is_nn4up'] = $b['is_nn3up'] && $b['is_major'] >= 4;
            $b['is_nn6']   = $b['is_nn4up'] && $b['is_major'] === 5;
            $b['is_nn6up'] = $b['is_nn4up'] && $b['is_major'] >= 5;
            $b['is_nn8']   = $b['is_nn6up'] && (bool)strpos($ua, 'Netscape/8');

        /**
        * Opera
        */
        } elseif ($b['is_opera']) {
            $b['is_opera5']   = strpos($ua, 'Opera/5') !== false;
            $b['is_opera6']   = strpos($ua, 'Opera/6') !== false;
            $b['is_opera7']   = strpos($ua, 'Opera/7') !== false;
            $b['is_opera8']   = strpos($ua, 'Opera/8') !== false;
            $b['is_opera9']   = (strpos($ua, 'Opera/9') !== false AND strpos($ua, 'Version/10') === false);
            $b['is_opera9.5'] = (strpos($ua, 'Opera/9.5') !== false AND strpos($ua, 'Version/10') === false);
            $b['is_opera10']  = strpos($ua, 'Version/10') !== false;

        /**
        * Chrome
        */
        } elseif ($b['is_chrome']) {
            $b['is_chrome4'] = strpos($ua, 'Chrome/4') !== false;
            $b['is_chrome3'] = strpos($ua, 'Chrome/3') !== false;
            $b['is_chrome2'] = strpos($ua, 'Chrome/2') !== false;
            $b['is_chrome1'] = strpos($ua, 'Chrome/1') !== false; // Untested
        
        /**
        * Other. Some of the more common robots etc...
        */
        } else {
            $b['is_google']    = strpos($ua, 'Mediapartners-Google') !== false;
            $b['is_googletb']  = strpos($ua, 'GoogleToolbar') !== false;
            $b['is_ffg']       = strpos($ua, 'Feedfetcher-Google') !== false;
            $b['is_googlebot'] = strpos($ua, 'Googlebot') !== false;
            
            $b['is_newsgator'] = strpos($ua, 'NewsGatorOnline/') !== false;
            $b['is_magpierss'] = strpos($ua, 'MagpieRSS') !== false;
            $b['is_planetphp'] = strpos($ua, 'PlanetPHPAggregator') !== false;
            $b['is_bloglines'] = strpos($ua, 'Bloglines') !== false;
            $b['is_doubanbot'] = strpos($ua, 'Doubanbot') !== false;
            $b['is_topix']     = strpos($ua, 'Topix.net') !== false;
            $b['is_rssreader'] = strpos($ua, 'RssReader') !== false;
            $b['is_nnw']       = strpos($ua, 'NetNewsWire') !== false;
            $b['is_ngo']       = strpos($ua, 'NewsGatorOnline') !== false;
            $b['is_gn']        = strpos($ua, 'GreatNews') !== false;
            $b['is_rb']        = strpos($ua, 'RssBar') !== false;
        }
        
        /**
        * Which version of windows?
        */
        if ($b['is_win']) {
            $b['is_98']      = strpos($ua, 'Windows 98')     !== false;
            $b['is_nt']      = strpos($ua, 'Windows NT 4.0') !== false;
            $b['is_2000']    = strpos($ua, 'Windows NT 5.0') !== false;
            $b['is_xp']      = strpos($ua, 'Windows NT 5.1') !== false;
            $b['is_2003']    = strpos($ua, 'Windows NT 5.2') !== false;
            $b['is_vista']   = strpos($ua, 'Windows NT 6.0') !== false;
            $b['is_win7']    = strpos($ua, 'Windows NT 6.1') !== false;

        /**
        * Macs
        */
        } elseif ($b['is_mac']) {
            $b['is_osx'] = strpos($ua, 'OS X') !== false;

        /**
        * *Nix
        */
        } elseif ($b['is_nix']) {
            $b['is_fed']    = strpos($ua, 'Fedora/') !== false;
            $b['is_ubuntu'] = strpos($ua, 'Ubuntu') !== false;
        }
        
        return $b;
    }
?>