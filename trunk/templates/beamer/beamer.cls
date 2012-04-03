

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>
  rivanvx / beamer / source &mdash; Bitbucket
</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <!--[if lt IE 9]>
  <script src="https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/js/lib/html5.js"></script>
  <![endif]-->

  <script>
    (function (window) {
      // prevent stray occurrences of `console.log` from causing errors in IE
      var console = window.console || (window.console = {});
      console.log || (console.log = function () {});

      var BB = window.BB || (window.BB = {});
      BB.debug = false;
      BB.cname = false;
      BB.CANON_URL = 'https://bitbucket.org';
      BB.MEDIA_URL = 'https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/';
      BB.images = {
        noAvatar: 'https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/img/no_avatar.png'
      };
      BB.user = {
        isKbdShortcutsEnabled: true,
        isSshEnabled: false
      };
      BB.user.has = (function () {
        var betaFeatures = [];
        betaFeatures.push('repo2');
        return function (feature) {
          return _.contains(betaFeatures, feature);
        };
      }());
      BB.repo || (BB.repo = {});
  
  
      BB.user.isAdmin = false;
      BB.repo.id = 57460;
    
    
      BB.repo.language = null;
      BB.repo.pygmentsLanguage = null;
    
    
      BB.repo.slug = 'beamer';
    
    
      BB.repo.owner = {
        username: 'rivanvx'
      };
    
      // Coerce `BB.repo` to a string to get
      // "davidchambers/mango" or whatever.
      BB.repo.toString = function () {
        return BB.cname ? this.slug : this.owner.username + '/' + this.slug;
      }
    
    
      BB.changeset = '2ff5461be705'
    
    
  
    }(this));
  </script>

  


  <link rel="stylesheet" href="https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/bun/css/bundle.css"/>



  <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="Bitbucket" />
  <link rel="icon" href="https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/img/logo_new.png" type="image/png" />
  <link type="text/plain" rel="author" href="/humans.txt" />


  
    <script src="https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/bun/js/bundle.js"></script>
  



</head>

<body id="" class="">
  <script>
    if (navigator.userAgent.indexOf(' AppleWebKit/') === -1) {
      $('body').addClass('non-webkit')
    }
    $('body')
      .addClass($.client.os.toLowerCase())
      .addClass($.client.browser.toLowerCase())
  </script>
  <!--[if IE 8]>
  <script>jQuery(document.body).addClass('ie8')</script>
  <![endif]-->
  <!--[if IE 9]>
  <script>jQuery(document.body).addClass('ie9')</script>
  <![endif]-->

  <div id="wrapper">



  <div id="header-wrap">
    <div id="header">
    <ul id="global-nav">
      <li><a class="home" href="http://www.atlassian.com">Atlassian Home</a></li>
      <li><a class="docs" href="http://confluence.atlassian.com/display/BITBUCKET">Documentation</a></li>
      <li><a class="support" href="/support">Support</a></li>
      <li><a class="blog" href="http://blog.bitbucket.org">Blog</a></li>
      <li><a class="forums" href="http://groups.google.com/group/bitbucket-users">Forums</a></li>
    </ul>
    <a href="/" id="logo">Bitbucket by Atlassian</a>

    <div id="main-nav">
    
      <ul class="clearfix">
        <li><a href="/plans">Pricing &amp; signup</a></li>
        <li><a id="explore-link" href="/explore">Explore Bitbucket</a></li>
        <li><a href="/account/signin/?next=/rivanvx/beamer/src/2ff5461be705/base/beamer.cls">Log in</a></li>
        

<li class="search-box">
  
    <form action="/repo/all">
      <input type="search" results="5" autosave="bitbucket-explore-search"
             name="name" id="searchbox"
             placeholder="owner/repo" />
  
  </form>
</li>

      </ul>
    
    </div>
    </div>
  </div>

    <div id="header-messages">
  
  
    
    
    
    
  

    
   </div>



    <div id="content">
      <div id="source">
      
  
  





  <script>
    jQuery(function ($) {
        var cookie = $.cookie,
            cookieOptions, date,
            $content = $('#content'),
            $pane = $('#what-is-bitbucket'),
            $hide = $pane.find('[href="#hide"]').css('display', 'block').hide();

        date = new Date();
        date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000);
        cookieOptions = { path: '/', expires: date };

        if (cookie('toggle_status') == 'hide') $content.addClass('repo-desc-hidden');

        $('#toggle-repo-content').click(function (event) {
            event.preventDefault();
            $content.toggleClass('repo-desc-hidden');
            cookie('toggle_status', cookie('toggle_status') == 'show' ? 'hide' : 'show', cookieOptions);
        });

        if (!cookie('hide_intro_message')) $pane.show();

        $hide.click(function (event) {
            event.preventDefault();
            cookie('hide_intro_message', true, cookieOptions);
            $pane.slideUp('slow');
        });

        $pane.hover(
            function () { $hide.fadeIn('fast'); },
            function () { $hide.fadeOut('fast'); });

      (function () {
        // Update "recently-viewed-repos" cookie for
        // the "repositories" drop-down.
        var
          id = BB.repo.id,
          cookieName = 'recently-viewed-repos_' + BB.user.id,
          rvr = cookie(cookieName),
          ids = rvr? rvr.split(','): [],
          idx = _.indexOf(ids, '' + id);

        // Remove `id` from `ids` if present.
        if (~idx) ids.splice(idx, 1);

        cookie(
          cookieName,
          // Insert `id` as the first item, then call
          // `join` on the resulting array to produce
          // something like "114694,27542,89002,84570".
          [id].concat(ids.slice(0, 4)).join(),
          {path: '/', expires: 1e6} // "never" expires
        );
      }());
    });
  </script>



  
  
  
  
  
    <div id="what-is-bitbucket" class="new-to-bitbucket">
      <h2>Vedran Miletić <span id="slogan">is sharing code with you</span></h2>
      <img src="https://secure.gravatar.com/avatar/6490659fba1f4bd9d623b7c937bb571f?d=identicon&s=32" alt="" class="avatar" />
      <p>Bitbucket is a code hosting site. Unlimited public and private repositories. Free for small teams.</p>
      <div class="primary-action-link signup"><a href="/account/signup/?utm_source=internal&utm_medium=banner&utm_campaign=what_is_bitbucket">Try Bitbucket free</a></div>
      <a href="#hide" title="Don't show this again">Don't show this again</a>
    </div>
  


<div id="tabs" class="tabs">
  <ul>
    <li>
      <a href="/rivanvx/beamer/overview" id="repo-overview-link">Overview</a>
    </li>

    <li>
      <a href="/rivanvx/beamer/downloads" id="repo-downloads-link">Downloads (<span id="downloads-count">0</span>)</a>
    </li>

    

    <li>
      <a href="/rivanvx/beamer/pull-requests" id="repo-pr-link">Pull requests (0)</a>
    </li>

    <li class="selected">
      
        <a href="/rivanvx/beamer/src" id="repo-source-link">Source</a>
      
    </li>

    <li>
      <a href="/rivanvx/beamer/changesets" id="repo-commits-link">Commits</a>
    </li>

    <li id="wiki-tab" class="dropdown"
      style="display:
          block 
        
      ">
      <a href="/rivanvx/beamer/wiki" id="repo-wiki-link">Wiki</a>
    </li>

    <li id="issues-tab" class="dropdown inertial-hover"
      style="display:
        block 
        
      ">
      <a href="/rivanvx/beamer/issues?status=new&amp;status=open" id="repo-issues-link">Issues (45) &raquo;</a>
      <ul>
        <li><a href="/rivanvx/beamer/issues/new">Create new issue</a></li>
        <li><a href="/rivanvx/beamer/issues?status=new">New issues</a></li>
        <li><a href="/rivanvx/beamer/issues?status=new&amp;status=open">Open issues</a></li>
        <li><a href="/rivanvx/beamer/issues?status=duplicate&amp;status=invalid&amp;status=resolved&amp;status=wontfix">Closed issues</a></li>
        
        <li><a href="/rivanvx/beamer/issues">All issues</a></li>
        <li><a href="/rivanvx/beamer/issues/query">Advanced query</a></li>
      </ul>
    </li>

    
  </ul>

  <ul>
    <li>
      <a href="/rivanvx/beamer/descendants" id="repo-forks-link">Forks/queues (5)</a>
    </li>

    <li>
      <a href="/rivanvx/beamer/zealots">Followers (<span id="followers-count">98</span>)</a>
    </li>
  </ul>
</div>



 

  <div class="repo-menu" id="repo-menu">
    <ul id="repo-menu-links">
    
      <li>
        <a href="/rivanvx/beamer/rss" class="rss" title="RSS feed for beamer">RSS</a>
      </li>

      <li><a id="repo-fork-link" href="/rivanvx/beamer/fork" class="fork">fork</a></li>
      
        
          <li><a id="repo-patch-queue-link" href="/rivanvx/beamer/hack" class="patch-queue">patch queue</a></li>
        
      
      <li>
        <a id="repo-follow-link" rel="nofollow" href="/rivanvx/beamer/follow" class="follow">follow</a>
      </li>
      
          
      
      
        <li class="get-source inertial-hover">
          <a class="source">get source</a>
          <ul class="downloads">
            
              
              <li><a rel="nofollow" href="/rivanvx/beamer/get/2ff5461be705.zip">zip</a></li>
              <li><a rel="nofollow" href="/rivanvx/beamer/get/2ff5461be705.tar.gz">gz</a></li>
              <li><a rel="nofollow" href="/rivanvx/beamer/get/2ff5461be705.tar.bz2">bz2</a></li>
            
          </ul>
        </li>
      
    </ul>

  
    <ul class="metadata">
      
      
        <li class="branches inertial-hover">branches
          <ul>
            <li><a href="/rivanvx/beamer/src/2ff5461be705">default</a>
              
              
            </li>
            <li><a href="/rivanvx/beamer/src/10c7a1de136c">vendor</a>
              
              
              <a rel="nofollow" class="menu-compare"
                 href="/rivanvx/beamer/compare/vendor..default"
                 title="Show changes between vendor and the main branch.">compare</a>
              
            </li>
          </ul>
        </li>
      
      
      <li class="tags inertial-hover">tags
        <ul>
          <li><a href="/rivanvx/beamer/src/2ff5461be705">tip</a>
            
            </li>
          <li><a href="/rivanvx/beamer/src/46e1bc9c9b76">version-3-13</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-13"
                 title="Show changes between version-3-13 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/19e4c3c6fe54">version-3-12</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-12"
                 title="Show changes between version-3-12 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/70f9d8411e54">version-3-11</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-11"
                 title="Show changes between version-3-11 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/213fd269d3ef">version-3-10</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-10"
                 title="Show changes between version-3-10 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/f4a1dee0d1b1">version-3-09</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-09"
                 title="Show changes between version-3-09 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/034830dd53d9">version-3-08</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-08"
                 title="Show changes between version-3-08 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/36e9898de35c">version-3-07</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-07"
                 title="Show changes between version-3-07 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/d4628977abfc">version-3-06</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-3-06"
                 title="Show changes between version-3-06 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/25c1d2087065">release-2-99</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..release-2-99"
                 title="Show changes between release-2-99 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/33b4045ce69e">version-0-91</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-0-91"
                 title="Show changes between version-0-91 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/d9ee75f22f0a">version-0-90</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-0-90"
                 title="Show changes between version-0-90 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/10c7a1de136c">version-0-82</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..version-0-82"
                 title="Show changes between version-0-82 and the main branch.">compare</a>
            </li>
          <li><a href="/rivanvx/beamer/src/10c7a1de136c">start</a>
            
            
              <a rel="nofollow" class='menu-compare'
                 href="/rivanvx/beamer/compare/..start"
                 title="Show changes between start and the main branch.">compare</a>
            </li>
        </ul>
      </li>
     
     
    </ul>
  
</div>

<div class="repo-menu" id="repo-desc">
    <ul id="repo-menu-links-mini">
      

      
      <li>
        <a href="/rivanvx/beamer/rss" class="rss" title="RSS feed for beamer"></a>
      </li>

      <li><a href="/rivanvx/beamer/fork" class="fork" title="Fork"></a></li>
      
        
          <li><a href="/rivanvx/beamer/hack" class="patch-queue" title="Patch queue"></a></li>
        
      
      <li>
        <a rel="nofollow" href="/rivanvx/beamer/follow" class="follow">follow</a>
      </li>
      
          
      
      
        <li>
          <a class="source" title="Get source"></a>
          <ul class="downloads">
            
              
              <li><a rel="nofollow" href="/rivanvx/beamer/get/2ff5461be705.zip">zip</a></li>
              <li><a rel="nofollow" href="/rivanvx/beamer/get/2ff5461be705.tar.gz">gz</a></li>
              <li><a rel="nofollow" href="/rivanvx/beamer/get/2ff5461be705.tar.bz2">bz2</a></li>
            
          </ul>
        </li>
      
    </ul>

    <h3 id="repo-heading" class="public hg">
      <a class="owner-username" href="/rivanvx">rivanvx</a> /
      <a class="repo-name" href="/rivanvx/beamer/wiki/Home">beamer</a>
    
      <span><a href="http://www.inf.uniri.hr/~vmiletic/beamer.html">http://inf.uniri.hr/~vmiletic/beamer.html</a></span>
    

    
    </h3>

    
      <p class="repo-desc-description">LaTeX Beamer class development repository.</p>
    

  <div id="repo-desc-cloneinfo">Clone this repository (size: 21.7 MB):
    <a href="https://bitbucket.org/rivanvx/beamer" class="https">HTTPS</a> /
    <a href="ssh://hg@bitbucket.org/rivanvx/beamer" class="ssh">SSH</a>
    <pre id="clone-url-https">hg clone https://bitbucket.org/rivanvx/beamer</pre>
    <pre id="clone-url-ssh">hg clone ssh://hg@bitbucket.org/rivanvx/beamer</pre>
    
  </div>

        <a href="#" id="toggle-repo-content"></a>

        

</div>




      
  <div id="source-container">
    

  <div id="source-path">
    <h1>
      <a href="/rivanvx/beamer/src" class="src-pjax">beamer</a> /

  
    
      <a href="/rivanvx/beamer/src/2ff5461be705/base/" class="src-pjax">base</a> /
    
  

  
    
      <span>beamer.cls</span>
    
  

    </h1>
  </div>

  <div class="labels labels-csv">
  
    <dl>
  
    
  
  
    
  
  
    <dt>Branch</dt>
    
      
        <dd class="branch unabridged"><a href="/rivanvx/beamer/changesets/tip/branch(%22default%22)" title="default">default</a></dd>
      
    
  
</dl>

  
  </div>


  
  <div id="source-view">
    <div class="header">
      <ul class="metadata">
        <li><code>2ff5461be705</code></li>
        
          
            <li>384 loc</li>
          
        
        <li>11.1 KB</li>
      </ul>
      <ul class="source-view-links">
        
        <li><a id="embed-link" href="https://bitbucket.org/rivanvx/beamer/src/2ff5461be705/base/beamer.cls?embed=t">embed</a></li>
        
        <li><a href="/rivanvx/beamer/history/base/beamer.cls">history</a></li>
        
        <li><a href="/rivanvx/beamer/annotate/2ff5461be705/base/beamer.cls">annotate</a></li>
        
        <li><a href="/rivanvx/beamer/raw/2ff5461be705/base/beamer.cls">raw</a></li>
        <li>
          <form action="/rivanvx/beamer/diff/base/beamer.cls" class="source-view-form">
          
            <input type="hidden" name="diff2" value="70f9d8411e54" />
            <select name="diff1">
            
              
                <option value="70f9d8411e54">70f9d8411e54</option>
              
            
              
                <option value="6f3c10d5ac99">6f3c10d5ac99</option>
              
            
              
                <option value="a6b1a8434d30">a6b1a8434d30</option>
              
            
              
                <option value="0677185e52f6">0677185e52f6</option>
              
            
              
                <option value="bff0a9294b45">bff0a9294b45</option>
              
            
              
                <option value="1b0256162842">1b0256162842</option>
              
            
              
                <option value="647d08b36bfb">647d08b36bfb</option>
              
            
              
                <option value="26a58c6f1267">26a58c6f1267</option>
              
            
              
                <option value="d0b34a51204f">d0b34a51204f</option>
              
            
              
                <option value="7063f09e9019">7063f09e9019</option>
              
            
              
                <option value="751dcaeea5e0">751dcaeea5e0</option>
              
            
              
                <option value="efa082c6111d">efa082c6111d</option>
              
            
              
                <option value="6dd151388527">6dd151388527</option>
              
            
              
                <option value="982469101dd6">982469101dd6</option>
              
            
              
                <option value="5a25f58600c3">5a25f58600c3</option>
              
            
              
                <option value="41b5745e061e">41b5745e061e</option>
              
            
              
                <option value="165210fa3865">165210fa3865</option>
              
            
              
                <option value="25f85d59db1e">25f85d59db1e</option>
              
            
              
                <option value="d8963a755aa7">d8963a755aa7</option>
              
            
              
                <option value="23a715253d39">23a715253d39</option>
              
            
              
                <option value="8b34d0c9f803">8b34d0c9f803</option>
              
            
              
                <option value="56a0ec10ee5c">56a0ec10ee5c</option>
              
            
              
                <option value="90e850259b8b">90e850259b8b</option>
              
            
              
                <option value="63c55952007b">63c55952007b</option>
              
            
              
                <option value="8f9548efde44">8f9548efde44</option>
              
            
              
                <option value="0eb69e4fe8b1">0eb69e4fe8b1</option>
              
            
              
                <option value="6bc5acedf18d">6bc5acedf18d</option>
              
            
              
                <option value="042c0c75e164">042c0c75e164</option>
              
            
              
                <option value="b988ea7cc1e9">b988ea7cc1e9</option>
              
            
              
                <option value="a7e3ab968329">a7e3ab968329</option>
              
            
              
                <option value="746096b1468c">746096b1468c</option>
              
            
              
                <option value="945fc2e622f2">945fc2e622f2</option>
              
            
              
                <option value="ca8ccffc9719">ca8ccffc9719</option>
              
            
              
                <option value="3d89e86e2b1d">3d89e86e2b1d</option>
              
            
              
                <option value="658b973cc2a5">658b973cc2a5</option>
              
            
              
                <option value="3baf135d62f8">3baf135d62f8</option>
              
            
              
                <option value="acaadf1318bb">acaadf1318bb</option>
              
            
              
                <option value="7accf3d7db8d">7accf3d7db8d</option>
              
            
              
                <option value="f717c1054c33">f717c1054c33</option>
              
            
              
                <option value="35bbd9429fe1">35bbd9429fe1</option>
              
            
              
                <option value="4e80a67a520d">4e80a67a520d</option>
              
            
              
                <option value="25c1d2087065">25c1d2087065</option>
              
            
              
                <option value="70d0009ead61">70d0009ead61</option>
              
            
              
                <option value="33952c576b45">33952c576b45</option>
              
            
              
                <option value="2ba42ea3d01b">2ba42ea3d01b</option>
              
            
              
                <option value="437089f03990">437089f03990</option>
              
            
              
                <option value="47a5615942fe">47a5615942fe</option>
              
            
              
                <option value="6a8f2b410299">6a8f2b410299</option>
              
            
              
                <option value="9f771b50f7ba">9f771b50f7ba</option>
              
            
              
                <option value="36c175b29ecd">36c175b29ecd</option>
              
            
            </select>
            <input type="submit" value="diff" />
          
          </form>
        </li>
      </ul>
    </div>
  
    <div>
    <table class="highlighttable"><tr><td class="linenos"><div class="linenodiv"><pre><a href="#cl-1">  1</a>
<a href="#cl-2">  2</a>
<a href="#cl-3">  3</a>
<a href="#cl-4">  4</a>
<a href="#cl-5">  5</a>
<a href="#cl-6">  6</a>
<a href="#cl-7">  7</a>
<a href="#cl-8">  8</a>
<a href="#cl-9">  9</a>
<a href="#cl-10"> 10</a>
<a href="#cl-11"> 11</a>
<a href="#cl-12"> 12</a>
<a href="#cl-13"> 13</a>
<a href="#cl-14"> 14</a>
<a href="#cl-15"> 15</a>
<a href="#cl-16"> 16</a>
<a href="#cl-17"> 17</a>
<a href="#cl-18"> 18</a>
<a href="#cl-19"> 19</a>
<a href="#cl-20"> 20</a>
<a href="#cl-21"> 21</a>
<a href="#cl-22"> 22</a>
<a href="#cl-23"> 23</a>
<a href="#cl-24"> 24</a>
<a href="#cl-25"> 25</a>
<a href="#cl-26"> 26</a>
<a href="#cl-27"> 27</a>
<a href="#cl-28"> 28</a>
<a href="#cl-29"> 29</a>
<a href="#cl-30"> 30</a>
<a href="#cl-31"> 31</a>
<a href="#cl-32"> 32</a>
<a href="#cl-33"> 33</a>
<a href="#cl-34"> 34</a>
<a href="#cl-35"> 35</a>
<a href="#cl-36"> 36</a>
<a href="#cl-37"> 37</a>
<a href="#cl-38"> 38</a>
<a href="#cl-39"> 39</a>
<a href="#cl-40"> 40</a>
<a href="#cl-41"> 41</a>
<a href="#cl-42"> 42</a>
<a href="#cl-43"> 43</a>
<a href="#cl-44"> 44</a>
<a href="#cl-45"> 45</a>
<a href="#cl-46"> 46</a>
<a href="#cl-47"> 47</a>
<a href="#cl-48"> 48</a>
<a href="#cl-49"> 49</a>
<a href="#cl-50"> 50</a>
<a href="#cl-51"> 51</a>
<a href="#cl-52"> 52</a>
<a href="#cl-53"> 53</a>
<a href="#cl-54"> 54</a>
<a href="#cl-55"> 55</a>
<a href="#cl-56"> 56</a>
<a href="#cl-57"> 57</a>
<a href="#cl-58"> 58</a>
<a href="#cl-59"> 59</a>
<a href="#cl-60"> 60</a>
<a href="#cl-61"> 61</a>
<a href="#cl-62"> 62</a>
<a href="#cl-63"> 63</a>
<a href="#cl-64"> 64</a>
<a href="#cl-65"> 65</a>
<a href="#cl-66"> 66</a>
<a href="#cl-67"> 67</a>
<a href="#cl-68"> 68</a>
<a href="#cl-69"> 69</a>
<a href="#cl-70"> 70</a>
<a href="#cl-71"> 71</a>
<a href="#cl-72"> 72</a>
<a href="#cl-73"> 73</a>
<a href="#cl-74"> 74</a>
<a href="#cl-75"> 75</a>
<a href="#cl-76"> 76</a>
<a href="#cl-77"> 77</a>
<a href="#cl-78"> 78</a>
<a href="#cl-79"> 79</a>
<a href="#cl-80"> 80</a>
<a href="#cl-81"> 81</a>
<a href="#cl-82"> 82</a>
<a href="#cl-83"> 83</a>
<a href="#cl-84"> 84</a>
<a href="#cl-85"> 85</a>
<a href="#cl-86"> 86</a>
<a href="#cl-87"> 87</a>
<a href="#cl-88"> 88</a>
<a href="#cl-89"> 89</a>
<a href="#cl-90"> 90</a>
<a href="#cl-91"> 91</a>
<a href="#cl-92"> 92</a>
<a href="#cl-93"> 93</a>
<a href="#cl-94"> 94</a>
<a href="#cl-95"> 95</a>
<a href="#cl-96"> 96</a>
<a href="#cl-97"> 97</a>
<a href="#cl-98"> 98</a>
<a href="#cl-99"> 99</a>
<a href="#cl-100">100</a>
<a href="#cl-101">101</a>
<a href="#cl-102">102</a>
<a href="#cl-103">103</a>
<a href="#cl-104">104</a>
<a href="#cl-105">105</a>
<a href="#cl-106">106</a>
<a href="#cl-107">107</a>
<a href="#cl-108">108</a>
<a href="#cl-109">109</a>
<a href="#cl-110">110</a>
<a href="#cl-111">111</a>
<a href="#cl-112">112</a>
<a href="#cl-113">113</a>
<a href="#cl-114">114</a>
<a href="#cl-115">115</a>
<a href="#cl-116">116</a>
<a href="#cl-117">117</a>
<a href="#cl-118">118</a>
<a href="#cl-119">119</a>
<a href="#cl-120">120</a>
<a href="#cl-121">121</a>
<a href="#cl-122">122</a>
<a href="#cl-123">123</a>
<a href="#cl-124">124</a>
<a href="#cl-125">125</a>
<a href="#cl-126">126</a>
<a href="#cl-127">127</a>
<a href="#cl-128">128</a>
<a href="#cl-129">129</a>
<a href="#cl-130">130</a>
<a href="#cl-131">131</a>
<a href="#cl-132">132</a>
<a href="#cl-133">133</a>
<a href="#cl-134">134</a>
<a href="#cl-135">135</a>
<a href="#cl-136">136</a>
<a href="#cl-137">137</a>
<a href="#cl-138">138</a>
<a href="#cl-139">139</a>
<a href="#cl-140">140</a>
<a href="#cl-141">141</a>
<a href="#cl-142">142</a>
<a href="#cl-143">143</a>
<a href="#cl-144">144</a>
<a href="#cl-145">145</a>
<a href="#cl-146">146</a>
<a href="#cl-147">147</a>
<a href="#cl-148">148</a>
<a href="#cl-149">149</a>
<a href="#cl-150">150</a>
<a href="#cl-151">151</a>
<a href="#cl-152">152</a>
<a href="#cl-153">153</a>
<a href="#cl-154">154</a>
<a href="#cl-155">155</a>
<a href="#cl-156">156</a>
<a href="#cl-157">157</a>
<a href="#cl-158">158</a>
<a href="#cl-159">159</a>
<a href="#cl-160">160</a>
<a href="#cl-161">161</a>
<a href="#cl-162">162</a>
<a href="#cl-163">163</a>
<a href="#cl-164">164</a>
<a href="#cl-165">165</a>
<a href="#cl-166">166</a>
<a href="#cl-167">167</a>
<a href="#cl-168">168</a>
<a href="#cl-169">169</a>
<a href="#cl-170">170</a>
<a href="#cl-171">171</a>
<a href="#cl-172">172</a>
<a href="#cl-173">173</a>
<a href="#cl-174">174</a>
<a href="#cl-175">175</a>
<a href="#cl-176">176</a>
<a href="#cl-177">177</a>
<a href="#cl-178">178</a>
<a href="#cl-179">179</a>
<a href="#cl-180">180</a>
<a href="#cl-181">181</a>
<a href="#cl-182">182</a>
<a href="#cl-183">183</a>
<a href="#cl-184">184</a>
<a href="#cl-185">185</a>
<a href="#cl-186">186</a>
<a href="#cl-187">187</a>
<a href="#cl-188">188</a>
<a href="#cl-189">189</a>
<a href="#cl-190">190</a>
<a href="#cl-191">191</a>
<a href="#cl-192">192</a>
<a href="#cl-193">193</a>
<a href="#cl-194">194</a>
<a href="#cl-195">195</a>
<a href="#cl-196">196</a>
<a href="#cl-197">197</a>
<a href="#cl-198">198</a>
<a href="#cl-199">199</a>
<a href="#cl-200">200</a>
<a href="#cl-201">201</a>
<a href="#cl-202">202</a>
<a href="#cl-203">203</a>
<a href="#cl-204">204</a>
<a href="#cl-205">205</a>
<a href="#cl-206">206</a>
<a href="#cl-207">207</a>
<a href="#cl-208">208</a>
<a href="#cl-209">209</a>
<a href="#cl-210">210</a>
<a href="#cl-211">211</a>
<a href="#cl-212">212</a>
<a href="#cl-213">213</a>
<a href="#cl-214">214</a>
<a href="#cl-215">215</a>
<a href="#cl-216">216</a>
<a href="#cl-217">217</a>
<a href="#cl-218">218</a>
<a href="#cl-219">219</a>
<a href="#cl-220">220</a>
<a href="#cl-221">221</a>
<a href="#cl-222">222</a>
<a href="#cl-223">223</a>
<a href="#cl-224">224</a>
<a href="#cl-225">225</a>
<a href="#cl-226">226</a>
<a href="#cl-227">227</a>
<a href="#cl-228">228</a>
<a href="#cl-229">229</a>
<a href="#cl-230">230</a>
<a href="#cl-231">231</a>
<a href="#cl-232">232</a>
<a href="#cl-233">233</a>
<a href="#cl-234">234</a>
<a href="#cl-235">235</a>
<a href="#cl-236">236</a>
<a href="#cl-237">237</a>
<a href="#cl-238">238</a>
<a href="#cl-239">239</a>
<a href="#cl-240">240</a>
<a href="#cl-241">241</a>
<a href="#cl-242">242</a>
<a href="#cl-243">243</a>
<a href="#cl-244">244</a>
<a href="#cl-245">245</a>
<a href="#cl-246">246</a>
<a href="#cl-247">247</a>
<a href="#cl-248">248</a>
<a href="#cl-249">249</a>
<a href="#cl-250">250</a>
<a href="#cl-251">251</a>
<a href="#cl-252">252</a>
<a href="#cl-253">253</a>
<a href="#cl-254">254</a>
<a href="#cl-255">255</a>
<a href="#cl-256">256</a>
<a href="#cl-257">257</a>
<a href="#cl-258">258</a>
<a href="#cl-259">259</a>
<a href="#cl-260">260</a>
<a href="#cl-261">261</a>
<a href="#cl-262">262</a>
<a href="#cl-263">263</a>
<a href="#cl-264">264</a>
<a href="#cl-265">265</a>
<a href="#cl-266">266</a>
<a href="#cl-267">267</a>
<a href="#cl-268">268</a>
<a href="#cl-269">269</a>
<a href="#cl-270">270</a>
<a href="#cl-271">271</a>
<a href="#cl-272">272</a>
<a href="#cl-273">273</a>
<a href="#cl-274">274</a>
<a href="#cl-275">275</a>
<a href="#cl-276">276</a>
<a href="#cl-277">277</a>
<a href="#cl-278">278</a>
<a href="#cl-279">279</a>
<a href="#cl-280">280</a>
<a href="#cl-281">281</a>
<a href="#cl-282">282</a>
<a href="#cl-283">283</a>
<a href="#cl-284">284</a>
<a href="#cl-285">285</a>
<a href="#cl-286">286</a>
<a href="#cl-287">287</a>
<a href="#cl-288">288</a>
<a href="#cl-289">289</a>
<a href="#cl-290">290</a>
<a href="#cl-291">291</a>
<a href="#cl-292">292</a>
<a href="#cl-293">293</a>
<a href="#cl-294">294</a>
<a href="#cl-295">295</a>
<a href="#cl-296">296</a>
<a href="#cl-297">297</a>
<a href="#cl-298">298</a>
<a href="#cl-299">299</a>
<a href="#cl-300">300</a>
<a href="#cl-301">301</a>
<a href="#cl-302">302</a>
<a href="#cl-303">303</a>
<a href="#cl-304">304</a>
<a href="#cl-305">305</a>
<a href="#cl-306">306</a>
<a href="#cl-307">307</a>
<a href="#cl-308">308</a>
<a href="#cl-309">309</a>
<a href="#cl-310">310</a>
<a href="#cl-311">311</a>
<a href="#cl-312">312</a>
<a href="#cl-313">313</a>
<a href="#cl-314">314</a>
<a href="#cl-315">315</a>
<a href="#cl-316">316</a>
<a href="#cl-317">317</a>
<a href="#cl-318">318</a>
<a href="#cl-319">319</a>
<a href="#cl-320">320</a>
<a href="#cl-321">321</a>
<a href="#cl-322">322</a>
<a href="#cl-323">323</a>
<a href="#cl-324">324</a>
<a href="#cl-325">325</a>
<a href="#cl-326">326</a>
<a href="#cl-327">327</a>
<a href="#cl-328">328</a>
<a href="#cl-329">329</a>
<a href="#cl-330">330</a>
<a href="#cl-331">331</a>
<a href="#cl-332">332</a>
<a href="#cl-333">333</a>
<a href="#cl-334">334</a>
<a href="#cl-335">335</a>
<a href="#cl-336">336</a>
<a href="#cl-337">337</a>
<a href="#cl-338">338</a>
<a href="#cl-339">339</a>
<a href="#cl-340">340</a>
<a href="#cl-341">341</a>
<a href="#cl-342">342</a>
<a href="#cl-343">343</a>
<a href="#cl-344">344</a>
<a href="#cl-345">345</a>
<a href="#cl-346">346</a>
<a href="#cl-347">347</a>
<a href="#cl-348">348</a>
<a href="#cl-349">349</a>
<a href="#cl-350">350</a>
<a href="#cl-351">351</a>
<a href="#cl-352">352</a>
<a href="#cl-353">353</a>
<a href="#cl-354">354</a>
<a href="#cl-355">355</a>
<a href="#cl-356">356</a>
<a href="#cl-357">357</a>
<a href="#cl-358">358</a>
<a href="#cl-359">359</a>
<a href="#cl-360">360</a>
<a href="#cl-361">361</a>
<a href="#cl-362">362</a>
<a href="#cl-363">363</a>
<a href="#cl-364">364</a>
<a href="#cl-365">365</a>
<a href="#cl-366">366</a>
<a href="#cl-367">367</a>
<a href="#cl-368">368</a>
<a href="#cl-369">369</a>
<a href="#cl-370">370</a>
<a href="#cl-371">371</a>
<a href="#cl-372">372</a>
<a href="#cl-373">373</a>
<a href="#cl-374">374</a>
<a href="#cl-375">375</a>
<a href="#cl-376">376</a>
<a href="#cl-377">377</a>
<a href="#cl-378">378</a>
<a href="#cl-379">379</a>
<a href="#cl-380">380</a>
<a href="#cl-381">381</a>
<a href="#cl-382">382</a>
<a href="#cl-383">383</a>
<a href="#cl-384">384</a>
</pre></div></td><td class="code"><div class="highlight"><pre><a name="cl-1"></a><span class="nv">%</span> <span class="nv">Copyright</span> <span class="mi">2003</span><span class="nv">--</span><span class="mi">2007</span> <span class="nb">by</span> <span class="nv">Till</span> <span class="nv">Tantau</span>
<a name="cl-2"></a><span class="nv">%</span> <span class="nv">Copyright</span> <span class="mi">2010</span> <span class="nb">by</span> <span class="nv">Vedran</span> <span class="nv">Mileti</span><span class="o">\</span><span class="s1">&#39;c</span>
<a name="cl-3"></a><span class="s1">% Copyright 2011 by Vedran Mileti\&#39;c, Joseph Wright</span>
<a name="cl-4"></a><span class="s1">%</span>
<a name="cl-5"></a><span class="s1">% This file may be distributed and/or modified</span>
<a name="cl-6"></a><span class="s1">%</span>
<a name="cl-7"></a><span class="s1">% 1. under the LaTeX Project Public License and/or</span>
<a name="cl-8"></a><span class="s1">% 2. under the GNU Public License.</span>
<a name="cl-9"></a><span class="s1">%</span>
<a name="cl-10"></a><span class="s1">% See the file doc/licenses/LICENSE for more details.</span>
<a name="cl-11"></a>
<a name="cl-12"></a><span class="s1">\RequirePackage{beamerbasercs}</span>
<a name="cl-13"></a><span class="s1">\ProvidesClassRCS $Header$</span>
<a name="cl-14"></a><span class="s1">[development version \beamer@version\space A class for typesetting presentations]</span>
<a name="cl-15"></a>
<a name="cl-16"></a>
<a name="cl-17"></a><span class="s1">\RequirePackage{beamerbasemodes}</span>
<a name="cl-18"></a><span class="s1">% Setup modes and check for article option</span>
<a name="cl-19"></a>
<a name="cl-20"></a><span class="s1">\beamer@transferifnecessary</span>
<a name="cl-21"></a>
<a name="cl-22"></a><span class="s1">\RequirePackage{ifpdf}</span>
<a name="cl-23"></a>
<a name="cl-24"></a><span class="s1">%</span>
<a name="cl-25"></a><span class="s1">%</span>
<a name="cl-26"></a><span class="s1">% Declarations used by beamer</span>
<a name="cl-27"></a><span class="s1">%</span>
<a name="cl-28"></a><span class="s1">%</span>
<a name="cl-29"></a>
<a name="cl-30"></a><span class="s1">% Public</span>
<a name="cl-31"></a><span class="s1">\newdimen\headheight    % Total height of the headline (including depth)</span>
<a name="cl-32"></a><span class="s1">\newdimen\headdp        % Depth of the headline</span>
<a name="cl-33"></a><span class="s1">\newdimen\footheight    % Height of the footline</span>
<a name="cl-34"></a><span class="s1">\newdimen\sidebarheight % Height of the sidebars</span>
<a name="cl-35"></a>
<a name="cl-36"></a><span class="s1">% Private</span>
<a name="cl-37"></a><span class="s1">\newdimen\beamer@tempdim</span>
<a name="cl-38"></a><span class="s1">\newdimen\beamer@finalheight</span>
<a name="cl-39"></a><span class="s1">\newdimen\beamer@animht</span>
<a name="cl-40"></a><span class="s1">\newdimen\beamer@animdp</span>
<a name="cl-41"></a><span class="s1">\newdimen\beamer@animwd</span>
<a name="cl-42"></a><span class="s1">\newdimen\beamer@leftmargin</span>
<a name="cl-43"></a><span class="s1">\newdimen\beamer@rightmargin</span>
<a name="cl-44"></a><span class="s1">\newdimen\beamer@leftsidebar</span>
<a name="cl-45"></a><span class="s1">\newdimen\beamer@rightsidebar</span>
<a name="cl-46"></a><span class="s1">\newdimen\beamer@boxsize</span>
<a name="cl-47"></a><span class="s1">\newdimen\beamer@vboxoffset</span>
<a name="cl-48"></a><span class="s1">\newdimen\beamer@descdefault</span>
<a name="cl-49"></a><span class="s1">\newdimen\beamer@descriptionwidth</span>
<a name="cl-50"></a>
<a name="cl-51"></a><span class="s1">\newskip\beamer@lastskip</span>
<a name="cl-52"></a>
<a name="cl-53"></a><span class="s1">\newbox\beamer@areabox</span>
<a name="cl-54"></a><span class="s1">\newbox\beamer@animcurrent</span>
<a name="cl-55"></a><span class="s1">\newbox\beamer@animshowbox</span>
<a name="cl-56"></a><span class="s1">\newbox\beamer@sectionbox</span>
<a name="cl-57"></a><span class="s1">\newbox\beamer@logobox</span>
<a name="cl-58"></a><span class="s1">\newbox\beamer@linebox</span>
<a name="cl-59"></a>
<a name="cl-60"></a><span class="s1">\newcount\beamer@sectioncount</span>
<a name="cl-61"></a><span class="s1">\newcount\beamer@subsubsectionmax</span>
<a name="cl-62"></a><span class="s1">\newcount\beamer@subsectionmax</span>
<a name="cl-63"></a><span class="s1">\newcount\beamer@sectionmax</span>
<a name="cl-64"></a><span class="s1">\newcount\beamer@totalheads</span>
<a name="cl-65"></a><span class="s1">\newcount\beamer@headcounter</span>
<a name="cl-66"></a><span class="s1">\newcount\beamer@partstartpage</span>
<a name="cl-67"></a><span class="s1">\newcount\beamer@sectionstartpage</span>
<a name="cl-68"></a><span class="s1">\newcount\beamer@subsectionstartpage</span>
<a name="cl-69"></a><span class="s1">\newcount\beamer@animationtempa</span>
<a name="cl-70"></a><span class="s1">\newcount\beamer@animationtempb</span>
<a name="cl-71"></a><span class="s1">\newcount\beamer@xpos</span>
<a name="cl-72"></a><span class="s1">\newcount\beamer@ypos</span>
<a name="cl-73"></a><span class="s1">\newcount\beamer@showpartnumber</span>
<a name="cl-74"></a><span class="s1">\newcount\beamer@currentsubsection</span>
<a name="cl-75"></a><span class="s1">\newcount\beamer@coveringdepth</span>
<a name="cl-76"></a><span class="s1">\newcount\beamer@sectionadjust</span>
<a name="cl-77"></a><span class="s1">\newcount\beamer@tocsectionnumber</span>
<a name="cl-78"></a>
<a name="cl-79"></a>
<a name="cl-80"></a><span class="s1">\newif\ifbeamer@sansmath</span>
<a name="cl-81"></a><span class="s1">\newif\ifbeamer@altmode</span>
<a name="cl-82"></a><span class="s1">\newif\ifbeamer@notes</span>
<a name="cl-83"></a><span class="s1">\newif\ifbeamer@notesnormals</span>
<a name="cl-84"></a><span class="s1">\newif\ifbeamer@compress</span>
<a name="cl-85"></a><span class="s1">\newif\ifbeamer@centered</span>
<a name="cl-86"></a><span class="s1">\newif\ifbeamer@draftmode</span>
<a name="cl-87"></a><span class="s1">\newif\ifbeamer@suppressreplacements % decides whether fonts should be substituted</span>
<a name="cl-88"></a><span class="s1">\newif\ifbeamer@frameswithnotesonly</span>
<a name="cl-89"></a><span class="s1">\newif\ifbeamer@ignorenonframe</span>
<a name="cl-90"></a><span class="s1">\newif\ifbeamer@autopdfinfo</span>
<a name="cl-91"></a>
<a name="cl-92"></a><span class="s1">\RequirePackage{beamerbaseoptions}</span>
<a name="cl-93"></a><span class="s1">% For option management</span>
<a name="cl-94"></a>
<a name="cl-95"></a>
<a name="cl-96"></a>
<a name="cl-97"></a><span class="s1">%</span>
<a name="cl-98"></a><span class="s1">%</span>
<a name="cl-99"></a><span class="s1">% Document options</span>
<a name="cl-100"></a><span class="s1">%</span>
<a name="cl-101"></a><span class="s1">%</span>
<a name="cl-102"></a>
<a name="cl-103"></a><span class="s1">\beamer@suppressreplacementsfalse</span>
<a name="cl-104"></a><span class="s1">\beamer@altmodefalse</span>
<a name="cl-105"></a><span class="s1">\beamer@notesfalse</span>
<a name="cl-106"></a><span class="s1">\beamer@notesnormalstrue</span>
<a name="cl-107"></a><span class="s1">\beamer@compressfalse</span>
<a name="cl-108"></a><span class="s1">\beamer@draftmodefalse</span>
<a name="cl-109"></a><span class="s1">\beamer@frameswithnotesonlyfalse</span>
<a name="cl-110"></a><span class="s1">\beamer@ignorenonframefalse</span>
<a name="cl-111"></a><span class="s1">\beamer@autopdfinfotrue</span>
<a name="cl-112"></a>
<a name="cl-113"></a><span class="s1">\DeclareOptionBeamer{usepdftitle}[true]{\csname beamer@autopdfinfo#1\endcsname}</span>
<a name="cl-114"></a><span class="s1">\DeclareOptionBeamer{envcountsect}{\beamer@countsecttrue}</span>
<a name="cl-115"></a><span class="s1">\DeclareOptionBeamer{notheorems}{\beamer@blocksfalse}</span>
<a name="cl-116"></a><span class="s1">\DeclareOptionBeamer{noamsthm}{\beamer@blocksfalse\beamer@amsfalse}</span>
<a name="cl-117"></a>
<a name="cl-118"></a><span class="s1">\DeclareOptionBeamer{compress}{\beamer@compresstrue}</span>
<a name="cl-119"></a>
<a name="cl-120"></a><span class="s1">\DeclareOptionBeamer{t}{\beamer@centeredfalse}</span>
<a name="cl-121"></a><span class="s1">\DeclareOptionBeamer{c}{\beamer@centeredtrue}</span>
<a name="cl-122"></a>
<a name="cl-123"></a>
<a name="cl-124"></a><span class="s1">\DeclareOptionBeamer{leqno}{\input{leqno.clo}}</span>
<a name="cl-125"></a><span class="s1">\DeclareOptionBeamer{fleqn}{\input{fleqn.clo}}</span>
<a name="cl-126"></a>
<a name="cl-127"></a><span class="s1">\def\beamer@currentmode{beamer}</span>
<a name="cl-128"></a><span class="s1">\DeclareOptionBeamer{handout}{\gdef\beamer@currentmode{handout}}</span>
<a name="cl-129"></a><span class="s1">\DeclareOptionBeamer{trans}{\gdef\beamer@currentmode{trans}}</span>
<a name="cl-130"></a>
<a name="cl-131"></a><span class="s1">\DeclareOptionBeamer{pdftex}{}% Used by hyperref</span>
<a name="cl-132"></a><span class="s1">\DeclareOptionBeamer{nativepdf}{}% Used by hyperref</span>
<a name="cl-133"></a><span class="s1">\DeclareOptionBeamer{pdfmark}{}% Used by hyperref</span>
<a name="cl-134"></a><span class="s1">\DeclareOptionBeamer{dvips}{}% Used by hyperref</span>
<a name="cl-135"></a><span class="s1">\DeclareOptionBeamer{dviwindo}{}% Used by hyperref</span>
<a name="cl-136"></a><span class="s1">\DeclareOptionBeamer{dvipsone}{}% Used by hyperref</span>
<a name="cl-137"></a><span class="s1">\DeclareOptionBeamer{vtex}{}% Used by hyperref</span>
<a name="cl-138"></a><span class="s1">\DeclareOptionBeamer{ps2pdf}{}% Used by hyperref</span>
<a name="cl-139"></a>
<a name="cl-140"></a><span class="s1">\DeclareOptionBeamer{ignorenonframetext}{\beamer@ignorenonframetrue}</span>
<a name="cl-141"></a>
<a name="cl-142"></a><span class="s1">\def\beamer@size{{size11.clo}}</span>
<a name="cl-143"></a><span class="s1">\DeclareOptionBeamer{bigger}{\def\beamer@size{{size12.clo}}}</span>
<a name="cl-144"></a><span class="s1">\DeclareOptionBeamer{smaller}{\def\beamer@size{{size10.clo}}}</span>
<a name="cl-145"></a>
<a name="cl-146"></a><span class="s1">\DeclareOptionBeamer{8pt}{\def\beamer@size{{size8.clo}}}</span>
<a name="cl-147"></a><span class="s1">\DeclareOptionBeamer{9pt}{\def\beamer@size{{size9.clo}}}</span>
<a name="cl-148"></a><span class="s1">\DeclareOptionBeamer{10pt}{\def\beamer@size{{size10.clo}}}</span>
<a name="cl-149"></a><span class="s1">\DeclareOptionBeamer{11pt}{\def\beamer@size{{size11.clo}}}</span>
<a name="cl-150"></a><span class="s1">\DeclareOptionBeamer{12pt}{\def\beamer@size{{size12.clo}}}</span>
<a name="cl-151"></a><span class="s1">\DeclareOptionBeamer{14pt}{\def\beamer@size{{size14.clo}}}</span>
<a name="cl-152"></a><span class="s1">\DeclareOptionBeamer{17pt}{\def\beamer@size{{size17.clo}}}</span>
<a name="cl-153"></a><span class="s1">\DeclareOptionBeamer{20pt}{\def\beamer@size{{size20.clo}}}</span>
<a name="cl-154"></a>
<a name="cl-155"></a><span class="s1">\DeclareOptionBeamer{draft}{\beamer@draftmodetrue}</span>
<a name="cl-156"></a><span class="s1">\pagenumbering{arabic}</span>
<a name="cl-157"></a><span class="s1">\def\insertpagenumber{\thepage}</span>
<a name="cl-158"></a>
<a name="cl-159"></a><span class="s1">\def\beamer@activecjk{}</span>
<a name="cl-160"></a><span class="s1">\def\beamer@hypercjk{}</span>
<a name="cl-161"></a>
<a name="cl-162"></a><span class="s1">\DeclareOptionBeamer{CJK}{\ExecuteOptionsBeamer{cjk}}</span>
<a name="cl-163"></a><span class="s1">\DeclareOptionBeamer{cjk}{</span>
<a name="cl-164"></a><span class="s1">  \def\beamer@hypercjk{\hypersetup{CJKbookmarks=true}}</span>
<a name="cl-165"></a>
<a name="cl-166"></a><span class="s1">  \def\beamer@activecjk{</span>
<a name="cl-167"></a><span class="s1">    % Activate all &gt;=128 characters.</span>
<a name="cl-168"></a><span class="s1">    \count@=127</span>
<a name="cl-169"></a><span class="s1">    \@whilenum\count@&lt;254 \do{%</span>
<a name="cl-170"></a><span class="s1">      \advance\count@ by 1</span>
<a name="cl-171"></a><span class="s1">      \lccode`\~=\count@</span>
<a name="cl-172"></a><span class="s1">      \catcode\count@=\active</span>
<a name="cl-173"></a><span class="s1">      \lowercase{\def~{\kern1ex}}</span>
<a name="cl-174"></a><span class="s1">    }</span>
<a name="cl-175"></a><span class="s1">  }</span>
<a name="cl-176"></a><span class="s1">}</span>
<a name="cl-177"></a>
<a name="cl-178"></a>
<a name="cl-179"></a>
<a name="cl-180"></a><span class="s1">% obsolete options</span>
<a name="cl-181"></a><span class="s1">\DeclareOptionBeamer{notes}[show]{\csname beamer@notesaction@#1\endcsname}</span>
<a name="cl-182"></a><span class="s1">\def\beamer@notesaction@hide{%</span>
<a name="cl-183"></a><span class="s1">  \ClassWarning{beamer}{This option is obsolete. Use beamer option</span>
<a name="cl-184"></a><span class="s1">    ``hide notes&#39;&#39; instead.}%</span>
<a name="cl-185"></a><span class="s1">  \beamer@notesfalse}</span>
<a name="cl-186"></a><span class="s1">\def\beamer@notesaction@show{%</span>
<a name="cl-187"></a><span class="s1">  \ClassWarning{beamer}{This option is obsolete. Use beamer option</span>
<a name="cl-188"></a><span class="s1">    ``show notes&#39;&#39; instead.}%</span>
<a name="cl-189"></a><span class="s1">  \beamer@notestrue}</span>
<a name="cl-190"></a><span class="s1">\def\beamer@notesaction@only{%</span>
<a name="cl-191"></a><span class="s1">  \ClassWarning{beamer}{This option is obsolete. Use beamer option</span>
<a name="cl-192"></a><span class="s1">    ``show only notes&#39;&#39; instead.}%</span>
<a name="cl-193"></a><span class="s1">  \beamer@notestrue</span>
<a name="cl-194"></a><span class="s1">  \beamer@notesnormalsfalse</span>
<a name="cl-195"></a><span class="s1">  \nofiles</span>
<a name="cl-196"></a><span class="s1">}</span>
<a name="cl-197"></a><span class="s1">\def\beamer@notesaction@onlyslideswithnotes{%</span>
<a name="cl-198"></a><span class="s1">  \beamer@notestrue%</span>
<a name="cl-199"></a><span class="s1">  \beamer@frameswithnotesonlytrue%</span>
<a name="cl-200"></a><span class="s1">  \nofiles</span>
<a name="cl-201"></a><span class="s1">}</span>
<a name="cl-202"></a><span class="s1">\DeclareOptionBeamer{inrow}{</span>
<a name="cl-203"></a><span class="s1">  \ClassError{beamer}{``inrow&#39;&#39; no longer supported. Use ``compress&#39;&#39; instead.}{}}</span>
<a name="cl-204"></a><span class="s1">\DeclareOptionBeamer{compressnotes}{%</span>
<a name="cl-205"></a><span class="s1">  \ClassWarning{beamer}{``compressnotes&#39;&#39; is obsolete. Use</span>
<a name="cl-206"></a><span class="s1">    \noexpand\setbeamertemplate{note page}[compressed] instead}</span>
<a name="cl-207"></a><span class="s1">  \AtBeginDocument{\beamertemplatenotecompress}}</span>
<a name="cl-208"></a><span class="s1">\DeclareOptionBeamer{notesonly}{</span>
<a name="cl-209"></a><span class="s1">  \ClassWarning{beamer}{``notesonly&#39;&#39; is obsolete. Use beamer option</span>
<a name="cl-210"></a><span class="s1">    ``show only notes&#39;&#39; instead.}</span>
<a name="cl-211"></a><span class="s1">  \beamer@notesaction@only}</span>
<a name="cl-212"></a><span class="s1">\DeclareOptionBeamer{blue}{</span>
<a name="cl-213"></a><span class="s1">  \ClassWarning{beamer}{``blue&#39;&#39; is obsolete. Use color theme structure instead}</span>
<a name="cl-214"></a><span class="s1">  \def\beamer@loadlater{\usecolortheme[rgb={0.2,0.2,0.7}]{structure}}}</span>
<a name="cl-215"></a><span class="s1">\DeclareOptionBeamer{red}{</span>
<a name="cl-216"></a><span class="s1">  \ClassWarning{beamer}{``red&#39;&#39; is obsolete. Use color theme structure instead}</span>
<a name="cl-217"></a><span class="s1">  \def\beamer@loadlater{\usecolortheme[rgb={0.7,0.2,0.2}]{structure}}}</span>
<a name="cl-218"></a><span class="s1">\DeclareOptionBeamer{blackandwhite}{</span>
<a name="cl-219"></a><span class="s1">  \ClassWarning{beamer}{``blackandwhite&#39;&#39; is obsolete. Use color theme structure instead}</span>
<a name="cl-220"></a><span class="s1">  \def\beamer@loadlater{\usecolortheme[rgb={0.2,0.2,0.2}]{structure}}}</span>
<a name="cl-221"></a><span class="s1">\DeclareOptionBeamer{brown}{</span>
<a name="cl-222"></a><span class="s1">  \ClassWarning{beamer}{``brown&#39;&#39; is obsolete. Use color theme structure instead}</span>
<a name="cl-223"></a><span class="s1">  \def\beamer@loadlater{\usecolortheme[rgb={0.66,0.4,0.166}]{structure}}}</span>
<a name="cl-224"></a><span class="s1">\DeclareOptionBeamer{slidescentered}{</span>
<a name="cl-225"></a><span class="s1">  \ClassWarning{beamer}{``slidescentered&#39;&#39; is obsolete. Use ``c&#39;&#39; instead}</span>
<a name="cl-226"></a><span class="s1">  \beamer@centeredtrue}</span>
<a name="cl-227"></a><span class="s1">\DeclareOptionBeamer{slidestop}{</span>
<a name="cl-228"></a><span class="s1">  \ClassWarning{beamer}{``slidestop&#39;&#39; is obsolete. Use ``t&#39;&#39; instead}</span>
<a name="cl-229"></a><span class="s1">  \beamer@centeredfalse}</span>
<a name="cl-230"></a><span class="s1">\DeclareOptionBeamer{sans}{%</span>
<a name="cl-231"></a><span class="s1">  \ClassWarning{beamer}{``sans&#39;&#39; is obsolete. Just remove this option}</span>
<a name="cl-232"></a><span class="s1">  \def\familydefault{\sfdefault}</span>
<a name="cl-233"></a><span class="s1">  \def\mathfamilydefault{\sfdefault}</span>
<a name="cl-234"></a><span class="s1">  \beamer@sansmathtrue</span>
<a name="cl-235"></a><span class="s1">}</span>
<a name="cl-236"></a><span class="s1">\DeclareOptionBeamer{serif}{%</span>
<a name="cl-237"></a><span class="s1">  \ClassWarning{beamer}{``serif&#39;&#39; is obsolete. Use font theme ``serif&#39;&#39; instead}</span>
<a name="cl-238"></a><span class="s1">  \def\familydefault{\rmdefault}</span>
<a name="cl-239"></a><span class="s1">  \def\mathfamilydefault{\rmdefault}</span>
<a name="cl-240"></a><span class="s1">  \beamer@sansmathfalse</span>
<a name="cl-241"></a><span class="s1">}</span>
<a name="cl-242"></a><span class="s1">\DeclareOptionBeamer{mathsans}{</span>
<a name="cl-243"></a><span class="s1">  \ClassWarning{beamer}{``mathsans&#39;&#39; is obsolete. Use font theme ``serif&#39;&#39; with option ``butsansserifmath&#39;&#39;}</span>
<a name="cl-244"></a><span class="s1">  \def\mathfamilydefault{\sfdefault}\beamer@sansmathtrue}</span>
<a name="cl-245"></a><span class="s1">\DeclareOptionBeamer{mathserif}{</span>
<a name="cl-246"></a><span class="s1">  \ClassWarning{beamer}{``mathserif&#39;&#39; is obsolete. Use font theme ``serif&#39;&#39; with option ``onlymath&#39;&#39;}</span>
<a name="cl-247"></a><span class="s1">  \def\mathfamilydefault{\rmdefault}\beamer@sansmathfalse}</span>
<a name="cl-248"></a><span class="s1">\DeclareOptionBeamer{professionalfont}{</span>
<a name="cl-249"></a><span class="s1">  \ClassWarning{beamer}{``professionalfont&#39;&#39; is obsolete. Use font theme ``professionalfonts&#39;&#39; instead}</span>
<a name="cl-250"></a><span class="s1">  \beamer@suppressreplacementstrue}</span>
<a name="cl-251"></a>
<a name="cl-252"></a><span class="s1">% has to be done here for compatibility</span>
<a name="cl-253"></a><span class="s1">\def\familydefault{\sfdefault}</span>
<a name="cl-254"></a><span class="s1">\def\mathfamilydefault{\sfdefault}</span>
<a name="cl-255"></a><span class="s1">\beamer@sansmathtrue</span>
<a name="cl-256"></a>
<a name="cl-257"></a>
<a name="cl-258"></a>
<a name="cl-259"></a><span class="s1">\PassOptionsToPackage{bookmarks=true,%</span>
<a name="cl-260"></a><span class="s1">  bookmarksopen=true,%</span>
<a name="cl-261"></a><span class="s1">  pdfborder={0 0 0},%</span>
<a name="cl-262"></a><span class="s1">  pdfhighlight={/N},%</span>
<a name="cl-263"></a><span class="s1">  linkbordercolor={.5 .5 .5}}{hyperref}</span>
<a name="cl-264"></a>
<a name="cl-265"></a><span class="s1">\DeclareOptionBeamer{pgf}{\PassOptionsToPackage{#1}{pgf}}</span>
<a name="cl-266"></a><span class="s1">\DeclareOptionBeamer{hyperref}{\PassOptionsToPackage{#1}{hyperref}}</span>
<a name="cl-267"></a><span class="s1">\DeclareOptionBeamer{color}{\PassOptionsToPackage{#1}{color}}</span>
<a name="cl-268"></a><span class="s1">\DeclareOptionBeamer{xcolor}{\PassOptionsToPackage{#1}{xcolor}}</span>
<a name="cl-269"></a>
<a name="cl-270"></a><span class="s1">\def\beamer@loaducs{}</span>
<a name="cl-271"></a>
<a name="cl-272"></a><span class="s1">\DeclareOptionBeamer{ucs}{%</span>
<a name="cl-273"></a><span class="s1">  \ifpdf</span>
<a name="cl-274"></a><span class="s1">    \PassOptionsToPackage{pdftex,unicode}{hyperref}</span>
<a name="cl-275"></a><span class="s1">    \def\beamer@loaducs{</span>
<a name="cl-276"></a><span class="s1">      \RequirePackage[hyperref]{ucs}%</span>
<a name="cl-277"></a><span class="s1">      \AtBeginDocument{\PreloadUnicodePage{0}}%</span>
<a name="cl-278"></a><span class="s1">      \AtBeginDocument{\PreloadUnicodePage{1}}%</span>
<a name="cl-279"></a><span class="s1">    }</span>
<a name="cl-280"></a><span class="s1">  \else    </span>
<a name="cl-281"></a><span class="s1">    \def\beamer@loaducs{</span>
<a name="cl-282"></a><span class="s1">      \RequirePackage{ucs}%</span>
<a name="cl-283"></a><span class="s1">      \AtBeginDocument{\PreloadUnicodePage{0}}%</span>
<a name="cl-284"></a><span class="s1">      \AtBeginDocument{\PreloadUnicodePage{1}}%</span>
<a name="cl-285"></a><span class="s1">    }</span>
<a name="cl-286"></a><span class="s1">  \fi</span>
<a name="cl-287"></a><span class="s1">}</span>
<a name="cl-288"></a><span class="s1">\DeclareOptionBeamer{utf8x}{\ExecuteOptionsBeamer{ucs}%</span>
<a name="cl-289"></a><span class="s1">  \g@addto@macro\beamer@loaducs{\RequirePackage[utf8x]{inputenc}}%</span>
<a name="cl-290"></a><span class="s1">}</span>
<a name="cl-291"></a><span class="s1">\DeclareOptionBeamer{utf8}{</span>
<a name="cl-292"></a><span class="s1">  \ClassWarning{beamer}{This option works no longer loads ucs.}</span>
<a name="cl-293"></a><span class="s1">  \RequirePackage[utf8]{inputenc}</span>
<a name="cl-294"></a><span class="s1">  \PassOptionsToPackage{unicode}{hyperref}</span>
<a name="cl-295"></a><span class="s1">}</span>
<a name="cl-296"></a>
<a name="cl-297"></a><span class="s1">%</span>
<a name="cl-298"></a><span class="s1">% Geometry: allows 16:10, 16:9, 14:9, 5:4 and 4:3 (default 4:3).</span>
<a name="cl-299"></a><span class="s1">% Default value is set right after declaring width and height</span>
<a name="cl-300"></a><span class="s1">% because it doesn&#39;</span><span class="nv">t</span> <span class="nv">work</span> <span class="nb">otherwise</span><span class="p">.</span>
<a name="cl-301"></a><span class="nv">%</span>
<a name="cl-302"></a><span class="o">\</span><span class="nv">newlength</span><span class="o">\</span><span class="nv">beamer@paperwidth%</span>
<a name="cl-303"></a><span class="o">\</span><span class="nv">beamer@paperwidth</span> <span class="mf">12.80</span><span class="nv">cm%</span>
<a name="cl-304"></a><span class="o">\</span><span class="nv">newlength</span><span class="o">\</span><span class="nv">beamer@paperheight%</span>
<a name="cl-305"></a><span class="o">\</span><span class="nv">beamer@paperheight</span> <span class="mf">9.60</span><span class="nv">cm%</span>
<a name="cl-306"></a>
<a name="cl-307"></a><span class="o">\</span><span class="nv">DeclareOptionBeamer</span><span class="cp">{aspectratio}</span><span class="nv">[</span><span class="mi">43</span><span class="nv">]</span><span class="cp">{%</span>
<a name="cl-308"></a><span class="cp">  \ifnum#1=1610%</span>
<a name="cl-309"></a><span class="cp">    \beamer@paperwidth 16.00cm%</span>
<a name="cl-310"></a><span class="cp">    \beamer@paperheight 10.00cm%</span>
<a name="cl-311"></a><span class="cp">  \else\ifnum#1=169%</span>
<a name="cl-312"></a><span class="cp">    \beamer@paperwidth 16.00cm%</span>
<a name="cl-313"></a><span class="cp">    \beamer@paperheight 9.00cm%</span>
<a name="cl-314"></a><span class="cp">  \else\ifnum#1=149%</span>
<a name="cl-315"></a><span class="cp">    \beamer@paperwidth 14.00cm%</span>
<a name="cl-316"></a><span class="cp">    \beamer@paperheight 9.00cm%</span>
<a name="cl-317"></a><span class="cp">  \else\ifnum#1=54%</span>
<a name="cl-318"></a><span class="cp">    \beamer@paperwidth 12.50cm%</span>
<a name="cl-319"></a><span class="cp">    \beamer@paperheight 10.00cm%</span>
<a name="cl-320"></a><span class="cp">  \else\ifnum#1=43%</span>
<a name="cl-321"></a><span class="cp">    \beamer@paperwidth 12.80cm%</span>
<a name="cl-322"></a><span class="cp">    \beamer@paperheight 9.60cm%</span>
<a name="cl-323"></a><span class="cp">  \else\ifnum#1=32%</span>
<a name="cl-324"></a><span class="cp">    \beamer@paperwidth 13.50cm%</span>
<a name="cl-325"></a><span class="cp">    \beamer@paperheight 9.00cm%</span>
<a name="cl-326"></a><span class="cp">  \fi\fi\fi\fi\fi\fi%</span>
<a name="cl-327"></a><span class="cp">}</span>
<a name="cl-328"></a>
<a name="cl-329"></a><span class="o">\</span><span class="nv">RequirePackage[%</span>
<a name="cl-330"></a>  <span class="nv">papersize</span><span class="o">=</span><span class="cp">{\beamer@paperwidth,\beamer@paperheight}</span><span class="nv">,</span>
<a name="cl-331"></a>  <span class="nv">hmargin</span><span class="o">=</span><span class="mi">1</span><span class="nv">cm,%</span>
<a name="cl-332"></a>  <span class="nv">vmargin</span><span class="o">=</span><span class="mi">0</span><span class="nv">cm,%</span>
<a name="cl-333"></a>  <span class="nv">head</span><span class="o">=</span><span class="mf">0.5</span><span class="nv">cm,%</span> <span class="nv">might</span> <span class="nv">be</span> <span class="nv">changed</span> <span class="nv">later</span>
<a name="cl-334"></a>  <span class="nv">headsep</span><span class="o">=</span><span class="mi">0</span><span class="nv">pt,%</span>
<a name="cl-335"></a>  <span class="nv">foot</span><span class="o">=</span><span class="mf">0.5</span><span class="nv">cm%</span> <span class="nv">might</span> <span class="nv">be</span> <span class="nv">changed</span> <span class="nv">later</span>
<a name="cl-336"></a>  <span class="nv">]</span><span class="cp">{geometry}</span>
<a name="cl-337"></a>
<a name="cl-338"></a><span class="nv">%</span>
<a name="cl-339"></a><span class="nv">%</span> <span class="nb">Process</span> <span class="nv">Options</span>
<a name="cl-340"></a><span class="nv">%</span>
<a name="cl-341"></a>
<a name="cl-342"></a><span class="o">\</span><span class="nv">ExecuteOptionsBeamer</span><span class="cp">{c}</span>
<a name="cl-343"></a><span class="o">\</span><span class="nv">ProcessOptionsBeamer</span>
<a name="cl-344"></a>
<a name="cl-345"></a><span class="nv">%</span> <span class="nb">Load</span> <span class="nv">corresponding</span> <span class="nb">size</span> <span class="nb">file</span>
<a name="cl-346"></a><span class="o">\</span><span class="nv">expandafter</span><span class="o">\</span><span class="nb">input</span><span class="o">\</span><span class="nv">beamer@</span><span class="nb">size</span>
<a name="cl-347"></a>
<a name="cl-348"></a><span class="nv">%</span> <span class="nv">Filter</span> <span class="nb">class</span> <span class="nb">option</span> <span class="nv">list</span>
<a name="cl-349"></a><span class="o">\</span><span class="nv">beamer@filterclassoptions</span>
<a name="cl-350"></a>
<a name="cl-351"></a>
<a name="cl-352"></a><span class="o">\</span><span class="nv">RequirePackage</span><span class="cp">{pgfcore}</span>
<a name="cl-353"></a><span class="nv">%</span> <span class="nv">We</span> <span class="nv">need</span> <span class="nv">only</span> <span class="nv">the</span> <span class="nv">core</span> <span class="nv">stuff</span><span class="p">.</span>
<a name="cl-354"></a>
<a name="cl-355"></a><span class="o">\</span><span class="nv">RequirePackage</span><span class="cp">{xxcolor}</span>
<a name="cl-356"></a><span class="nv">%</span> <span class="nb">For</span> <span class="nb">color</span> <span class="nv">management</span> <span class="p">(</span><span class="nv">comes</span> <span class="nb">with</span> <span class="nv">pgf</span><span class="p">).</span>
<a name="cl-357"></a>
<a name="cl-358"></a><span class="o">\</span><span class="nv">RequirePackage[implicit</span><span class="o">=</span><span class="nb">false</span><span class="nv">]</span><span class="cp">{hyperref}</span>
<a name="cl-359"></a><span class="nv">%</span> <span class="nb">For</span> <span class="nv">hyperlinks</span>
<a name="cl-360"></a>
<a name="cl-361"></a><span class="o">\</span><span class="nv">hypersetup</span><span class="cp">{pdfcreator={LaTeX with Beamer class version \beamer@version}}</span>
<a name="cl-362"></a>
<a name="cl-363"></a><span class="nv">%</span> <span class="nv">Coding</span> <span class="nv">stuff</span>
<a name="cl-364"></a><span class="o">\</span><span class="nv">beamer@loaducs</span>
<a name="cl-365"></a><span class="o">\</span><span class="nv">beamer@hypercjk</span>
<a name="cl-366"></a>
<a name="cl-367"></a>
<a name="cl-368"></a><span class="o">\</span><span class="nv">RequirePackage</span><span class="cp">{beamerbaserequires}</span>
<a name="cl-369"></a><span class="nv">%</span> <span class="nv">Beamer</span> <span class="nv">packages</span> <span class="nv">required</span> <span class="nv">both</span> <span class="nb">by</span> <span class="nv">presentation</span> <span class="nb">and</span> <span class="nv">article</span> <span class="nv">modes</span>
<a name="cl-370"></a>
<a name="cl-371"></a><span class="nv">%</span> <span class="nv">Defaults</span>
<a name="cl-372"></a><span class="o">\</span><span class="nv">normalfont</span>
<a name="cl-373"></a><span class="o">\</span><span class="nv">raggedright</span>
<a name="cl-374"></a>
<a name="cl-375"></a><span class="o">\</span><span class="nv">AtBeginDocument</span>
<a name="cl-376"></a><span class="cp">{</span>
<a name="cl-377"></a><span class="cp">  \addtocontents{toc}{\protect\beamer@endinputifotherversion{\beamer@version pt}}</span>
<a name="cl-378"></a><span class="cp">  \addtocontents{nav}{\protect\beamer@endinputifotherversion{\beamer@version pt}}</span>
<a name="cl-379"></a><span class="cp">}</span>
<a name="cl-380"></a>
<a name="cl-381"></a><span class="o">\</span><span class="nv">usetheme</span><span class="cp">{default}</span>
<a name="cl-382"></a>
<a name="cl-383"></a><span class="nv">%</span> <span class="nv">Compatibility</span> <span class="nv">stuff</span>
<a name="cl-384"></a><span class="o">\</span><span class="nv">csname</span> <span class="nv">beamer@loadlater</span><span class="o">\</span><span class="nv">endcsname</span>
</pre></div>
</td></tr></table>
    </div>
  
  </div>
  


  <div id="mask"><div></div></div>

  </div>

      </div>
    </div>

  </div>

  <div id="footer">
    <ul id="footer-nav">
      <li>Copyright © 2012 <a href="http://atlassian.com">Atlassian</a></li>
      <li><a href="http://www.atlassian.com/hosted/terms.jsp">Terms of Service</a></li>
      <li><a href="http://www.atlassian.com/about/privacy.jsp">Privacy</a></li>
      <li><a href="//bitbucket.org/site/master/issues/new">Report a Bug to Bitbucket</a></li>
      <li><a href="http://confluence.atlassian.com/x/IYBGDQ">API</a></li>
      <li><a href="http://status.bitbucket.org/">Server Status</a></li>
    </ul>
    <ul id="social-nav">
      <li class="blog"><a href="http://blog.bitbucket.org">Bitbucket Blog</a></li>
      <li class="twitter"><a href="http://www.twitter.com/bitbucket">Twitter</a></li>
    </ul>
    <h5>We run</h5>
    <ul id="technologies">
      <li><a href="http://www.djangoproject.com/">Django 1.3.1</a></li>
      <li><a href="//bitbucket.org/jespern/django-piston/">Piston 0.3dev</a></li>
      <li><a href="http://git-scm.com/">Git 1.7.6</a></li>
      <li><a href="http://www.selenic.com/mercurial/">Hg 1.9.2</a></li>
      <li><a href="http://www.python.org">Python 2.7.2</a></li>
      <li>554269dd6adc | bitbucket05</li>
    </ul>
  </div>

  <script src="https://dwz7u9t8u8usb.cloudfront.net/m/057de5aa4e4d/js/lib/global.js"></script>






  <script>
    BB.gaqPush(['_trackPageview']);
  
    BB.gaqPush(['atl._trackPageview']);

    

    

    (function () {
        var ga = document.createElement('script');
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        ga.setAttribute('async', 'true');
        document.documentElement.firstChild.appendChild(ga);
    }());
  </script>

</body>
</html>
