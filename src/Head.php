<?php
//----------------------------------------------------------------------------
// HTML 'head' element
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use Jaypha\Jayponents\Component;


class Head extends Component
{
  //---------------------------------------------

  public $metaTags = [];
  public $title;
  public $description = null;
  public $manifest = null;

  public $scriptFiles = []; // Scripts that are stored in external files.
  public $scriptText = [];
  public $cssFiles = [];    // Stylesheet files.
  public $cssText = [];    // Styles to be printed in the page

  //---------------------------------------------

  function addMetaTag($name, $content, $httpEquiv = null, $charset = null)
  {
    $x = new Element("meta");
    $x->attributes["name"] = $name;
    $x->attributes["content"] = $content;
    if ($httpEquiv)
      $x->attributes["httpEquiv"] = $httpEquiv;
    if ($charset)
      $x->attributes["charset"] = $charset;
    $this->metaTags[] = $x;
    return $x;
  }

  //---------------------------------------------

  function display()
  {
    echo "<head><title>$this->title</title>";

    if ($this->description)
      echo "<meta name='description' content='".htmlspecialchars($this->description, ENT_QUOTES|ENT_HTML5),"'/>";

    foreach ($this->metaTags as $m)
      $m->display();

    if ($this->manifest !== null)
      echo "<link rel='manifest' href='$this->manifest'>";
    
    foreach ($this->cssFiles as $f)
      if (is_string($f))
        echo "<link rel='stylesheet' type='text/css' href='$f'>";
      else
        echo element("link", array_merge(["rel"=> "stylesheet", "type"=>"text/css"],$f));

    if (count($this->cssText))
    {
      echo "<style type='text/css'>";
      foreach ($this->cssText as $t)
        echo $t;
      echo "</style>";
    }

    foreach ($this->scriptFiles as $f)
      if (is_string($f))
        echo "<script src='$f'></script>";
      else
        echo element("script", $f);

    if (count($this->scriptText))
    {
      echo "<script type='text/javascript'>";
      foreach ($this->scriptText as $t)
        echo $t;
      echo "</script>";
    }

    parent::display();
    echo "</head>";
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2017 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
