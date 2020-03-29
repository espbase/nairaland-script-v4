<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
  <head>
    <meta content="width=device-width, initial-scale=1.0, user-scalable=0" name="viewport">
    <meta content="_qZagJmMBb81Pjmyox_0fMHzE5Ld2F1WBZAZmQA09FY" name="google-site-verification">
    <meta content="en" http-equiv="Content-Language">
    <link href="/favicon.ico" rel="icon" type="image/x-icon">
    <title>
      HLS Stream Tester - Free HTML5 M3U8 Player | Castr
    </title>
    <meta content="Test your Live HLS Streams Instantly using Castr HLS Embed Player. Embed M3U8 and HLS streams on your website using Free HTML5 Player. Live Stream Now!" name="description">
    <meta content="hls stream tester, hls player, free hls player,hls player embed, hls stream checker,hls abr stream tester, hls stream analyzer,hls streaming server,live streaming cdn, stream to multiple sites,live streaming, castr.io, castr" name="keywords">
    <meta content="https://castr.io/hlsplayer" property="og:url">
    <meta content="website" property="og:type">
    <meta content="HLS Stream Tester - Free HTML5 M3U8 Player" property="og:title">
    <meta content="Test your Live HLS Streams Instantly using Castr HLS Embed Player. Embed M3U8 and HLS streams on your website using Free HTML5 Player. Live Stream Now!" property="og:description">
    <meta content="https://castr.io/streamtomultiplesites.png" property="og:image">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="HLS Stream Tester - Free HTML5 M3U8 Player" name="twitter:title">
    <meta content="Test your Live HLS Streams Instantly using Castr HLS Embed Player. Embed M3U8 and HLS streams on your website using Free HTML5 Player. Live Stream Now!" name="twitter:description">
    <meta content="https://castr.io/livestreamingcdn.png" name="twitter:image">
    <link href="https://castr.io/hlsplayer" rel="canonical">
    <link href="https://castr.io/hlsplayer" hreflang="x-default" rel="alternate">
    <link href="https://castr.io/hlsplayer" hreflang="en" rel="alternate">
    <link href="https://castr.io/br/hlsplayer" hreflang="pt-br" rel="alternate">
    <link href="/vendors/flexboxgrid/dist/flexboxgrid.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <link href="/css/shared/shared.css" rel="stylesheet">
    <link href="/css/shared/navbar.css" rel="stylesheet">
    <link href="/css/shared/footer.css" rel="stylesheet">
    <link href="/css/shared/addons.css" rel="stylesheet">
    <link href="/css/default.css" rel="stylesheet">
    <link href="/css/hlsplayer.css" rel="stylesheet">
    <script src="/vendors/isphone/isphone.min.js">
    </script>
    <script src="https://cdn.bitmovin.com/player/web/8.1.0/bitmovinplayer.js" type="text/javascript">
    </script>
    <script src="https://cdn.bitmovin.com/analytics/web/2.0/bitmovinanalytics.min.js" type="text/javascript">
    </script>
  </head>
  <body class="default" style="background-color:#192035 !important;">
    <div class="app-nav">
      
      <script>
      (function () {
      var linksContainers = document.querySelectorAll('.nav-links')
      if (!linksContainers.length) return

      Array.prototype.forEach.call(linksContainers, function (linksContainer) {
      var token = window.localStorage.getItem('token')
      if (token)
      linksContainer.classList.add('loggedin')
      })
      })()
      </script>
      <script>
      var allowedLangs = ['en', 'br']
      var allowedLangTitles = ['English (EN)', 'Português (BR)']
      var allowedLangTitlesShort = ['EN', 'BR']

      var pagePathname = window.location.pathname
      var baseLang = (pagePathname || '').split('/')
      baseLang = baseLang[0] || baseLang[1]

      if (!baseLang || allowedLangs.indexOf(baseLang) === -1) {
      baseLang = 'en'
      }

      var langStackIndex = allowedLangs.indexOf(baseLang)
      var langControl = document.querySelector('#lang-dropdown')

      var titleStack = window.phone ? allowedLangTitlesShort : allowedLangTitles
      document.querySelector('#lang-dropdown .dropdown-button').innerHTML = titleStack[langStackIndex]

      var langsItem = document.querySelectorAll('#lang-dropdown .dropdown-item')
      Array.prototype.forEach.call(langsItem, function (langItem) {
      if (!langItem) return
      if (!langItem.dataset.langId) return

      langItem.classList.remove('active')
      if (langItem.dataset.langId === baseLang)
      langItem.classList.add('active')
      })
      </script>
    </div>
    <div class="container page-content" style="text-align:center">

      <div class="playerwrapper">
        <div id="playback-source-error-wrapper">
          
        </div>
        <div class="hls-player"></div>
      </div>

      <div class="formwrapper">
        <form class="hero-form" id="form" name="form">
          
          
          <div id="error-wrapper"></div>
        </form>
      </div><br>

   
</div>
    <script>
    var errorWrapper = document.getElementById('error-wrapper')

    bindPlayer()
    setTimeout(playStream.bind(undefined, getDefaultHlsUrl()))

    function bindPlayer () {
    var playerConfig = {
    key: '731cb904-5208-47db-9891-5da3131270f1',
    analytics: {
      key: 'bf60fe72-02ec-40bd-8670-4b231f656607',
      videoId: 'castr-hls-player',
      title: 'Castr HLS Stream Test Page'
    },
    playback: {
      muted: true,
      autoplay: true
    },
    cast: {
      enable: true
    },
    style: {
      width: '20%'
    },
    logs: { bitmovin: false }
    };

    bitmovin.player.Player.addModule(bitmovin.analytics.PlayerModule);

    //- var playerWrapper = document.getElementById('hls-player');
    var playerWrapper = document.querySelector('.hls-player');
    var player = new bitmovin.player.Player(playerWrapper, playerConfig);
    window.player = player
    }

    function getDefaultHlsUrl () {
    return 'http://radio.citizentv.co.ke/radiocitizen/radiocitizen/chunklist_w441014684.m3u8'
    }

    function playStream (hlsUrl) {
    clearErrorMessage()

    player.innerHTML = ''

    var streamSource = hlsUrl
    if (!streamSource) {
    streamSource = document.getElementById('stream-url')
    if (!streamSource || !(streamSource = streamSource.value)) {
      errorWrapper.innerHTML = 'invalid or incomplete stream source'
      return
    }
    }

    errorWrapper.innerHTML = ''

    //- defining player playback config
    var playbackSource = { hls: streamSource }
    window.player.load(playbackSource).then(onPlayerLoad, onPlayerLoadError)
    }

    function onPlayerLoad () {
    clearErrorMessage()
    }

    function onPlayerLoadError (e) {
    console.log('player-error', e)

    showErrorMessage()
    setTimeout(function () {
    var nativeEl = document.querySelector('.bmpui-ui-errormessage-overlay')
    if (nativeEl) nativeEl.innerHTMl = ''
    }, 500)

    //- schedule playback retry
    setTimeout(function () { bindPlayer(true) }, 5000)
    }

    function showErrorMessage () {
    document.getElementById('playback-source-error-wrapper').className ='enabled'
    }

    function clearErrorMessage () {
    document.getElementById('playback-source-error-wrapper').className =''
    }
    </script>
    <script>
    window.intercomSettings = { app_id: 'mho3vqb9' };
    </script>
    <script>
    (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/mho3vqb9';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120812059-1">
    </script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-120812059-1');
    </script>
    <script>
    (function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h._hjSettings={hjid:913846,hjsv:6};
    a=o.getElementsByTagName('head')[0];
    r=o.createElement('script');r.async=1;
    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
    a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <script>
    !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on"];analytics.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);analytics.push(e);return analytics}};for(var t=0;t<analytics.methods.length;t++){var e=analytics.methods[t];analytics[e]=analytics.factory(e)}analytics.load=function(t,e){var n=document.createElement("script");n.type="text/javascript";n.async=!0;n.src="https://cdn.segment.com/analytics.js/v1/"+t+"/analytics.min.js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(n,a);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.1.0";
    analytics.load("oAFTjc7FwYvLRdMoKmwfvMlfVMRa4Cdk");
    analytics.page();
    }}();
    </script>
  </body>
</html>