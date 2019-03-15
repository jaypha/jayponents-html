<?php
//----------------------------------------------------------------------------
// HTML 'head' element
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use Jaypha\Jayponents\Component;


class Head extends Component
{
  //---------------------------------------------

  public $title;
  public $description = null;
  public $manifest = null;

  //---------------------------------------------

  // These are now deprecated. Use add<> methods instead.
  private $_metaTags;
  private $_scriptFiles; // Scripts that are stored in external files.
  private $_scriptText;
  private $_cssFiles;    // Stylesheet files.
  private $_cssText;    // Styles to be printed in the page

  //---------------------------------------------

  function __construct()
  {
    $this->_metaTags = new \ArrayObject();
    $this->_scriptFiles = new \ArrayObject();
    $this->_scriptText = new \ArrayObject();
    $this->_cssFiles = new \ArrayObject();
    $this->_cssText = new \ArrayObject();
  }

  function addMetaTag($name = null, $content = null, $httpEquiv = null, $charset = null)
  {
    $x = new Element("meta");
    if ($name)
      $x->attributes["name"] = $name;
    if ($content)
      $x->attributes["content"] = $content;
    if ($httpEquiv)
      $x->attributes["httpEquiv"] = $httpEquiv;
    if ($charset)
      $x->attributes["charset"] = $charset;
    $this->add($x);
    return $x;
  }

  function addBaseElement($href = null, $target = null)
  {
    $x = new Element("script");
    $this->add($x);
    if ($href)
      $x->attributes["href"] = $href;
    if ($target)
      $x->attributes["target"] = $target;
    return $x;
  }

  function addScriptTag($src = null, $isModule = false)
  {
    $x = new Element("script");
    if ($src)
      $x->attributes["src"] = $src;
    if ($isModule)
      $x->attributes["type"] = "module";
    $this->add($x);
    return $x;
  }

  function addStyleTag()
  {
    $x = new Element("style");
    $this->add($x);
    return $x;
  }

  function addLinkTag()
  {
    $x = new Element("link");
    $this->add($x);
    return $x;
  }

  function addStylesheet($file)
  {
    $x = $this->addLinkTag();
    $x->attributes["rel"] = "stylesheet";
    $x->attributes["href"] = $file;
    return $x;
  }

  //---------------------------------------------

  function display()
  {
    echo "<head><title>$this->title</title>";

    if ($this->description)
      echo "<meta name='description' content='".htmlspecialchars($this->description, ENT_QUOTES|ENT_HTML5),"'/>";

    parent::display();

    if ($this->manifest !== null)
      echo "<link rel='manifest' href='$this->manifest'>";

    foreach ($this->_metaTags as $m)
      $m->display();

    
    foreach ($this->_cssFiles as $f)
      if (is_string($f))
        echo "<link rel='stylesheet' href='$f'>";
      else
        echo element("link", array_merge(["rel"=> "stylesheet"],$f));

    if (count($this->_cssText))
    {
      echo "<style>";
      foreach ($this->_cssText as $t)
        echo $t;
      echo "</style>";
    }

    foreach ($this->_scriptFiles as $f)
      if (is_string($f))
        echo "<script src='$f'></script>";
      else
        echo element("script", $f);

    if (count($this->_scriptText))
    {
      echo "<script>";
      foreach ($this->_scriptText as $t)
        echo $t;
      echo "</script>";
    }

    echo "</head>";
  }

  //---------------------------------------------

  function __get($p)
  {
    switch ($p)
    {
      case "metaTags":
      case "cssFiles":
      case "scriptFiles":
      case "cssText":
      case "scriptText":
        trigger_error("Head::$p is deprecated", E_USER_DEPRECATED);
        $p = "_$p";
        return $this->$p;
    }
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2017 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
