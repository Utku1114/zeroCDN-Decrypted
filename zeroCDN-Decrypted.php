<?php

/*
 ·▄▄▄▄•▄▄▄ .▄▄▄         ▄▄· ·▄▄▄▄   ▐ ▄ 
▪▀·.█▌▀▄.▀·▀▄ █·▪     ▐█ ▌▪██▪ ██ •█▌▐█
▄█▀▀▀•▐▀▀▪▄▐▀▀▄  ▄█▀▄ ██ ▄▄▐█· ▐█▌▐█▐▐▌
█▌▪▄█▀▐█▄▄▌▐█•█▌▐█▌.▐▌▐███▌██. ██ ██▐█▌
·▀▀▀ • ▀▀▀ .▀  ▀ ▀█▄▀▪·▀▀▀ ▀▀▀▀▀• ▀▀ █▪

      ** zeroCDN - API-Version v0.3 **
	  ** exclusively made for GVMPC **
      **    made by zeroday#1337    **
          **    cracked by Utku#7318    **
      
 */

define('ACCESS_TOKEN_SALT', 'fdsN3mEfC-tY');

class FloodProtection
{

    /**
     * Predefined URLs to bypass without protection
     */

    private static $bypassURLs = [
        '/^\/huso.php\/hund\/bastard.*/'
    ];

    /**
     * Predefined IPs for which not to show this check
     */

    private static $bypassIPs = [
        '127.0.0.1'
    ];

    /**
     * Browser check initializer
     */

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $domain = $_SERVER['SERVER_NAME'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        @$cookie = $_COOKIE['__access'];
        $clientIP = self::GetClientIP();
        $verify = md5(ACCESS_TOKEN_SALT.$clientIP.$browser.$_SERVER['SERVER_NAME']);
        $bypass = false;
        foreach(self::$bypassIPs as $ip){
            if($clientIP == $ip) {
                $bypass = true;
                break;
            }
        }
        foreach(self::$bypassURLs as $burl){
            if(preg_match($burl, $url)) $bypass=true;
        }
        if ($cookie != $verify && !self::IsBot() && $bypass == false) {
            self::GenerateBrowserCheck($domain, $verify, $browser, $url);
        }
    }

    /**
     * A content body for browser check script page
     */

    protected static function GenerateBrowserCheck($domain, $cookie, $browser, $referrer)
    {
        ?>

<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
        <title>zeroCDN - Firewall</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
        <style>
            * {
                box-sizing: border-box;
            }
            ::after,
            ::before {
                box-sizing: border-box;
            }
            html {
                -ms-overflow-style: -ms-autohiding-scrollbar;
                -webkit-text-size-adjust: 100%;
                font-size: 16px;
                overflow-x: hidden;
                overflow-y: visible;
            }
            body {
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                background: #fafafa;
                color: #888;
                font-family: Poppins, Helvetica, sans-serif;
                line-height: 1.16;
                margin: 0;
                min-width: 20rem;
                overflow-x: hidden;
                overflow-y: hidden;
                text-align: center;
                height: 100%;
            }
            p {
                margin: 0;
                padding: 0;
            }
            h2 {
                color: #000;
                font-size: 1.25rem;
                margin: 0 0 1rem 0;
            }
            .loader {
                -moz-align-items: center;
                -moz-flex-flow: column nowrap;
                -ms-flex-align: center;
                -ms-flex-flow: column nowrap;
                -webkit-align-items: center;
                -webkit-box-align: center;
                -webkit-flex-flow: column nowrap;
                align-items: center;
                display: -moz-flex;
                display: -ms-flexbox;
                display: -webkit-box;
                display: -webkit-flex;
                display: flex;
                flex-flow: column nowrap;
                margin: auto;
            }
            .loader__items {
                display: -moz-flex;
                display: -ms-flexbox;
                display: -webkit-box;
                display: -webkit-flex;
                display: flex;
                margin: auto auto auto auto;
            }
            .loader__items:not(:last-child) {
                margin-bottom: 1rem;
            }
            .wrapper {
                -moz-flex-flow: column nowrap;
                -ms-flex-flow: column nowrap;
                -webkit-flex-flow: column nowrap;
                display: -moz-box;
                display: -ms-flexbox;
                display: -webkit-box;
                display: -webkit-flex;
                display: flex;
                flex-flow: column nowrap;
                min-height: 100vh;
                padding: 1.5rem 1rem;
            }
            .purple {
                color: #8950fc;
                font-weight: 600;
            }
            .main {
                -moz-box-align: center;
                -moz-box-flex: 1;
                -moz-flex-flow: column nowrap;
                -moz-flex: 1 1 auto;
                -ms-flex-align: center;
                -ms-flex-flow: column nowrap;
                -ms-flex: 1 1 auto;
                -webkit-align-items: center;
                -webkit-box-align: center;
                -webkit-box-flex: 1;
                -webkit-flex-flow: column nowrap;
                -webkit-flex: 1 1 auto;
                align-items: center;
                display: -moz-box;
                display: -ms-flexbox;
                display: -webkit-box;
                display: -webkit-flex;
                display: flex;
                flex-flow: column nowrap;
                flex: 1 1 auto;
            }
            .footer {
                -moz-box-flex: 0;
                -moz-flex: 0 0 auto;
                -ms-flex: 0 0 auto;
                -webkit-box-flex: 0;
                -webkit-flex: 0 0 auto;
                flex: 0 0 auto;
                font-size: 0.875rem;
            }
            .validation {
                margin: auto;
                max-width: 50rem;
                padding: 1rem 0;
                width: 100%;
            }
            .validation .loader__items {
                margin-bottom: 2rem;
                max-width: 4.938rem;
            }
            .validation h2 {
                font-size: 1.125rem;
                font-weight: 500;
            }
            .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
            }
            .lds-ellipsis div {
                position: absolute;
                top: 33px;
                width: 13px;
                height: 13px;
                border-radius: 50%;
                background: #8950fc;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
            }
            .lds-ellipsis div:nth-child(1) {
                left: 8px;
                animation: lds-ellipsis1 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(2) {
                left: 8px;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(3) {
                left: 32px;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(4) {
                left: 56px;
                animation: lds-ellipsis3 0.6s infinite;
            }
            @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
            }
            @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(0);
                }
            }
            @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }
                100% {
                    transform: translate(24px, 0);
                }
            }
            @media (prefers-color-scheme: dark) {
                body,
                html {
                    color: #dfdfdf !important;
                    background-color: #15161a !important;
                }
                h2 {
                    color: #fff !important;
                }
            }
        </style>
    </head>
<body>
    <script type="text/javascript">
        if(btoa(navigator.userAgent) 
            == '<?=base64_encode($browser); ?>'){
            document.cookie = '__access=<?=$cookie; ?>';
            setTimeout(function(){
                document.location.href = '<?=$referrer; ?>';
            }, 5000);
        } else {
            alert('Your browser sent a mismatched verification data. '+
                    'Please disable any browser extensions that might cause this issue to grant access to this website. '+
                    'Thank you!');
        }
    </script>


<header style="display: none;"></header>
        <div class="loader is-active" id="loading-content">
            <div class="wrapper">
                <main class="main">
                    <div class="validation">
                    <img src="https://i.imgur.com/AraCZ0M.png" style="    width: 294px;   margin: -32px;">
                        <div class="loader__items"></div>
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <h2>zeroCDN - DDoS Protection</h2>
                        <p>Wir prüfen nur kurz deinen Browser, du wirst gleich weitergeleitet.</p>
                    </div>
                </main>
                <footer class="footer">
                    <p>Layer7 Protection powered by <span class="purple">zeroday#1337</span></p>
                    <noscript>Please enable Javascript to see the requested page.</noscript>
                </footer>
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js?render=6LdG5hAaAAAAAOKkrIS2OfIRqlKkiQm3AK0xuR5s"></script>

</body>
</html>

        <?php
        exit;
    }

    /**
     * A function to identify real client IP address. 
     * One of those environment variables should be passed by web server to PHP
     */

    public static function GetClientIP()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }

            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                return $_SERVER['HTTP_CLIENT_IP'];
            }

            return $_SERVER['REMOTE_ADDR'];
        }

        if (getenv('HTTP_X_FORWARDED_FOR')) {
            return getenv('HTTP_X_FORWARDED_FOR');
        }

        if (getenv('HTTP_CLIENT_IP')) {
            return getenv('HTTP_CLIENT_IP');
        }

        return getenv('REMOTE_ADDR');
    }

    /**
     * Identifies a search bot / crawler by client header
     * UPD: perform additional checks since not that much of a secure way
     */

    protected static function IsBot()
    {
        return
            isset($_SERVER['HTTP_USER_AGENT'])
            && preg_match('/aolbuild|baidu|bingbot|msnbot|bingpreview|duckduckgo|adsbot-google|googlebot|mediapartners-google|teoma|slurp|yandex/i', $_SERVER['HTTP_USER_AGENT'])
          ;
    }
}

$protection = new FloodProtection();
 

//added botcheck
