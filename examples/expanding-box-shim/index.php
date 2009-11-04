<?PHP

include "../index.php";

$shell['title3'] = "Expanding box with shim";

$shell['h2'] = 'With HTTP requests, less is more!';

// ========================================================================== //
// CSS
// ========================================================================== //

ob_start();
?>
/* Two HTTP requests? How lame is that? */

.lame_box {
  width: 220px;
  background: url(bg_top.gif) no-repeat 0 0;
}

.lame_box-inner {
  padding: 20px;
  background: url(bg_bottom.gif) no-repeat 0 100%;
}

/* A single HTTP request? How delightful! */

.cool_box,
.cool_box-shim {
  background: url(bg.gif) no-repeat 0 0;
}

.cool_box {
  width: 180px;       /* Width of the box / bg graphic, minus the padding */
  padding: 20px;      /* Everyone loves padding! */
  
  position: relative;
}

.cool_box-shim {
  height: 20px;       /* Change this to a number <= the bottom padding */
  
  background-position: 0 100%;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  
  _padding: 0 20px;   /* Change the 20px to whatever padding the parent box has. */
  _bottom: -1px;      /* Without this, sometimes you see a line at the bottom in IE6. */
  _width: 100%;       /* Another IE6-only "fix" */
}

/* What's this? Another, totally different looking box
   in the same HTTP request? No way! */

.cool_box_alt {
  background-position: -220px 0;
}

.cool_box_alt .cool_box-shim {
  background-position: -220px 100%;
}

/* This stuff isn't really important, it just helps make the example look pretty. */

.box {
  float: left;
  margin-right: 10px;
}

.box h3,
.box p {
  margin: 0 0 0.6em;
}
<?
$shell['css'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" language="javascript">

$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
});

</script>
<style type="text/css" title="text/css">

/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/

#page {
  width: 700px;
}

.box a {
  color: #00f;
}

.box a:hover {
  color: #000;
}

<?= $shell['css']; ?>

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>

<p>
  I'm sure this has been done a million times before, but it just came to me yesterday, so I figured I'd
  write up an example <a href="http://benalman.com/news/2009/11/css-with-http-requests-less-is-more/">on my site</a>. Also note that I'm not suggesting these boxes actually look cool, it's the CSS
  technique, that while very simple and maybe obvious, is actually cool.
</p>
<p>
  And don't forget to <a href="http://benalman.com/news/2009/11/css-with-http-requests-less-is-more/">post comments or feedback</a>, thanks!
</p>

<div class="lame_box box">
  <div class="lame_box-inner">
    <h3>This box is lame!</h3>
    <p>
      In order to be resizable vertically, the background image has been split into two
      separate files, <a href="bg_top.gif">bg_top.gif</a> and <a href="bg_bottom.gif">bg_bottom.gif</a>.
    </p>
    <p>
      The outer div background is the overly-tall top image, anchored to the top, while the inner div background is the short bottom "end cap" image, anchored to the bottom.
    </p>
    <p>
      While this is a pretty standard way to make a resizable box, it requires two images (two HTTP
      requests), which isn't great!
    </p>
    <p>
      Also, keep in mind that this implementation is limited to the height of the top image. If you want
      an infinitely-resizable box, you'd actually need three images (three HTTP requests), which is not at all good!
    </p>
    <p>
      
    </p>
  </div>
</div>

<div class="cool_box box">
  <h3>This box is cool!</h3>
  <p>
    While the CSS used for this box might be slightly more complicated, the benefit is that only one
    image, <a href="bg.gif">bg.gif</a>, is used. And when you inspect that image, you'll see
    that it actually contains the background for not one, but two differently styled boxes!
  </p>
  <p>
    In fact, you can use this single image for many other CSS sprite images, thereby further reducing
    the number of HTTP requests your page makes, which helps to save page load time.
  </p>
  <p>
    Are there any caveats? Not really. You're going to be height-limited, so if you really want an infinitely-resizable
    box, you're going to need three images. But that shouldn't be necessary, since you can just make your single
    image as tall as you need, and then some. For example, these box images are 1000px tall, which should be more than enough for
    the content.
  </p>
  <div class="cool_box-shim"></div>
</div>

<div class="cool_box cool_box_alt box">
  <h3>This box is also cool!</h3>
  <p>
    <em>(continued)</em>
    Also, when you calculate the box width, you need to take padding into consideration. Just a little
    math, which shouldn't be a problem. Finally, if you care about how the box renders in IE6, you'll need to hack in
    a few styles (shown below, prefixed with _ so they only affect IE6).
  </p>
  <p>
    If you want to use this technique, you should only need to change the box and shim background image,
    the box width and padding, and if you set the shim height to the value of the padding (or less), you
    won't need to mess with z-indexes. Also, for IE6, you'll need to set the padding appropriately.
  </p>
  <p>
    Also, if you want to set the height to something specific, you'll need to set it on the parent container (in the
    "lame" version, you'd need to set it on the inner container).
  </p>
  <div class="cool_box-shim"></div>
</div>

<div style="clear:both"></div>

<h3>The code</h3>

<pre class="brush:css">
<?= htmlspecialchars( $shell['css'] ); ?>
</pre>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
