<?php
error_reporting(E_ALL);
/*

    Example for Safehtml

*/

define('XML_HTMLSAX3', dirname(__FILE__)."/classes/");
?>
<html>
<head>
  <style>
  STRIKE, S { color:#999999 }
  </style>
</head>
<body>
<h2>SAFEHTML Testing interface</h2>
This parser strip down all potentially dangerous content within HTML:
<ul>
<li> opening tag without its closing tag
<li> closing tag without its opening tag
<li> any of these tags: "base", "basefont", "head", "html", "body", "applet", "object", "iframe", "frame", "frameset", "script", "layer", "ilayer", "embed", "bgsound", "link", "meta", "style", "title", "blink", "xml" etc.
<li> any of these attributes: on*, data*, dynsrc
<li> javascript:/vbscript:/about: etc. protocols
<li> expression/behavior etc. in styles
<li> any other active content
</ul>
<p>If you found any bugs in this parser, please inform me &mdash; ICQ:551593 or <a href=mailto:thingol@mail.ru>thingol@mail.ru</a> - Roman Ivanov.

<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<textarea name="html" rows="10" cols="100">
<?
if (isset($_POST["html"])) 
{
 $_POST["html"] = stripslashes($_POST["html"]);
 echo htmlspecialchars($_POST["html"]);
}
?>
</textarea>
<input type="submit">
</form>
<?php
require_once('classes/safehtml.php');

function getmicrotime(){ 
  list($usec, $sec) = explode(" ",microtime()); 
  return ((float)$usec + (float)$sec); 
}


if (isset($_POST["html"])) 
{
 $doc=$_POST["html"];

 // Instantiate the handler
 $safehtml =& new safehtml();

 echo ('<pre>');
 // Time HTMLSax
 $start = getmicrotime();
 $result = $safehtml->parse($doc);
 echo ( "Parsing took seconds:\t\t".(getmicrotime()-$start) );
 echo ('</pre>');

 echo ('<b>Source code after filtration:</b><br/>');
 echo ( htmlspecialchars($result) );

 echo ('<p><b>Code after filtration as is (HTML):</b><br/>');
 echo ( $result );
}
?>
<hr>
<h3>Many thanks:</h3>
<ul>
<li> HTMLSax authors
<li> lj user=BOLK
<li> lj user=ati & lj user=curiousweasel
<li> lj user=teplorod
<li> Boris Bogdanov
<li> Mash
<li> lj user=electrocat
<li> shmel
<li> John "Gozzy" Godsland
<li> Christian Stocker
<li> Nick Cleaton
</ul>
<hr /> <a href="http://pixel-apes.com/safehtml">Download Safehtml</a>.
<br /> Copyright &copy; 2004-2005, Roman Ivanov.
<br /> All rights reserved.

</body>
</html>