<?php
include "includes/Parsedown.php";

class AGM {
  public function __construct () {
    $this->repoOwner = "KoffeinFlummi";
    $this->repoName = "AGM";
  }

  private function getGithubAPIContent ($url) {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_USERAGENT,'agm.koffeinflummi.de');
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
  }

  public function printFeatureList () {
    $featureURL = "https://raw.githubusercontent.com/wiki/".$this->repoOwner."/".$this->repoName."/Home.md";
    $raw = file_get_contents($featureURL);
    $parsedown = new Parsedown();
    $text = $parsedown->text($raw);
    echo substr($text, strpos($text, "\n")+1);
  }

  public function printDownloadButton () {
    $releasesURL = "https://api.github.com/repos/".$this->repoOwner."/".$this->repoName."/releases";
    try {
      $releasesData = json_decode($this->getGithubAPIContent($releasesURL));
      $url = $releasesData[0]->{"html_url"};
      $name = $releasesData[0]->{"name"};
      $date = strtotime($releasesData[0]->{"published_at"});
      $download = $releasesData[0]->{"assets"}[0]->{"browser_download_url"};

      echo "<a href='".$download."' title='Download' class='button'>";
      echo "<small>Download Latest</small>";
      echo $name;
      echo "</a>";
      echo date("Y-m-d", $date)." &bull; <a href='".$url."'>Release Notes</a>";
    } catch (Exception $e) {
      echo "Error fetching release status:<br/>";
      echo $e;
    }
  }
}

$AGM = new AGM()
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="stylesheets/pygment_trac.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="stylesheets/print.css" media="print" />

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title>AGM for Arma 3</title>
  </head>

  <body>
    <header class="header">
      <div class="inner">
        <h1>Authentic Gameplay Modification</h1>
        <h2>A modular, open-source mod for Arma 3, partly based on Taosenai's TMR.</h2>
      </div>
    </header>

    <a href="https://github.com/KoffeinFlummi/AGM"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/652c5b9acfaddf3a9c326fa6bde407b87f7be0f4/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png"></a>

    <div id="content-wrapper">
      <div class="inner clearfix">
        <section id="main-content">
          <?php
            $AGM->printFeatureList()
          ?>
        </section>

        <aside id="sidebar">

          <?php
            $AGM->printDownloadButton()
          ?>

          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="HPAXPTVCNLDZS">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
          </form>

          <!--
          <a href="#" class="button">
            <small>Latest Stable</small>
            v 1.0
          </a>
          <a href="#" class="button">
            <small>Latest Beta</small>
            v 1.0.12
          </a>
          
          <div class="sidenav-helper" style="width: 0; height: 0"></div>
          <ul class="sidenav">
            <li id="nav-philosophy"><a href="#philosophy">Philosphy</a></li>
            <li id="nav-features"><a href="#features">Features</a></li>
            <li id="nav-plans"><a href="#plans">Plans</a></li>
            <li id="nav-contribute"><a href="#contribute">Contribute</a></li>
            <li id="nav-contact"><a href="#contact">Contact</a></li>
          </ul>
          -->

        </aside>
      
      </div>
    </div>
    
    <footer class="footer">
      <div class="inner">
        <p>
          This page is being maintained by <a href="https://github.com/KoffeinFlummi">KoffeinFlummi</a> and based on the Architect theme by <a href="https://twitter.com/jasonlong">Jason Long</a>.
        </p>
        <p class="license">
          The Authentic Gameplay Modification is released under the GNU General Public License 2. For more information check the <a href="https://raw.githubusercontent.com/KoffeinFlummi/AGM/master/LICENSE">license file</a> attached to the project.
        </p>
      </div>
    </footer>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    
    <!--
    <script>
      // GOOGLE ANALYTICS
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49519886-1', 'koffeinflummi.github.io');
      ga('send', 'pageview');
    </script>
    -->

    <script>
      // PARALLAX EFFECT
      (function(window,document,undefined){
        $(window).scroll(function() {
          if ($(window).width() <= 767) {return 0;}
          var yPosH = ($(window).scrollTop() / 3) - 15; 
          var coordsH = '50% '+ yPosH + 'px';
          var yPosF = ($(window).scrollTop() / 3) - 90; 
          var coordsF = '50% '+ yPosF + 'px';
          $(".header").css({ backgroundPosition: coordsH });
          $(".footer").css({ backgroundPosition: coordsF });
        });
      })(this,this.document);
    </script>
    
    <script>
      // SMOOTH ANCHOR LINKS
      (function(window,document,undefined){
        $('a').click(function(){
          $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
          }, 500);
          return false;
        });
      })(this,this.document);
    </script>
    
    <script>
      // STICKY SIDE MENU
      (function(window,document,undefined){
        $(window).scroll(function() {
          $el = $('.sidenav'); 
          if ($(this).scrollTop() + 20 > $(".sidenav-helper").offset().top && $el.css('position') != 'fixed'){ 
            $el.css({'position': 'fixed', 'top': '0px', 'margin-top': '20px'}); 
          } else {
            if ($(this).scrollTop() + 20 <= $(".sidenav-helper").offset().top && $el.css('position') == 'fixed') {
              $el.css({'position': 'relative', 'margin-top': '0'});
            }
          }

          $(".sidenav li").removeClass("active");
          if ($(this).scrollTop() + 5 >= $("#contact").offset().top) {
            $("#nav-contact").addClass("active");
            return 0;
          }
          if ($(this).scrollTop() + 5 >= $("#contribute").offset().top) {
            $("#nav-contribute").addClass("active");
            return 0;
          }
          if ($(this).scrollTop() + 5 >= $("#plans").offset().top) {
            $("#nav-plans").addClass("active");
            return 0;
          }
          if ($(this).scrollTop() + 5 >= $("#features").offset().top) {
            $("#nav-features").addClass("active");
            return 0;
          }
          if ($(this).scrollTop() + 5 >= $("#philosophy").offset().top) {
            $("#nav-philosophy").addClass("active");
            return 0;
          }
          
        });
      })(this,this.document);
    </script>

  
  </body>
</html>
