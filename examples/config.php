<?PHP

$shell['title1'] = "CSS";
//$shell['link1']  = "http://benalman.com/";

ob_start();
/*
?>
  <a href="http://benalman.com/projects/jquery-XXX-plugin/">Project Home</a>,
  <a href="http://benalman.com/code/projects/jquery-XXX/docs/">Documentation</a>,
  <a href="http://github.com/cowboy/jquery-XXX/">Source</a>
<?
*/
$shell['h3'] = ob_get_contents();
ob_end_clean();

$shell['jquery'] = 'jquery-1.3.2.js';

$shell['shBrush'] = array( 'Css', 'JScript' );

?>
