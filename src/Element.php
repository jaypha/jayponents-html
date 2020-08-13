<?php
//----------------------------------------------------------------------------
// Component for HTML Elements
//----------------------------------------------------------------------------
// An example of a jayponent compoent that handles boiler plate internally.
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use Jaypha\Jayponents\Component;

require_once __DIR__."/helpers.php";

// This is a transitionary class. Eventually it will be replaced with Ds\Set.
// Adding new classes via [] is deprecated. Use add() instead.

class cssSet extends \ArrayObject
{
  function add($v) { if (!in_array($v, $this->getArrayCopy())) $this->append($v); }
  function remove($v) { $key = array_search($v, $this->getArrayCopy()); if ($key !== false) $this->offsetUnset($key); }
}

class Element extends Component
{
  const VOID_ELEMENTS = [
    "input", "img", "br", "base", "area", "command",
    "col", "hr", "link", "keygen", "meta"
  ];

  public $tagName = "div";
  public $cssStyles = [];
  public $attributes = [];
  public $cssClasses;

  private $scripts = [];

  function __construct(string $tagName = 'div')
  {
    $this->tagName = $tagName;
    $this->cssClasses = new cssSet();
  }

  //-----------------------------------

  function display()
  {
    assert(!array_key_exists("style", $this->attributes));
    assert(!array_key_exists("class", $this->attributes));
    echo "<$this->tagName";
    if (count($this->cssClasses))
      echo " class='",implode(" ",$this->cssClasses->getArrayCopy()),"'";
    if (count($this->attributes)) {
      foreach ($this->attributes as $k => $v) {
        if ($v !== false && $v !== null)
        {
          echo " $k";
          if ($v !== true)
            echo "='",htmlspecialchars($v, ENT_QUOTES|ENT_HTML5),"'";
        }
      }
    }
    if (count($this->cssStyles)) {
      echo " style='";
      foreach ($this->cssStyles as $k => $v)
        echo "$k:$v;";
      echo "'";
    }
    echo ">";
    if (!in_array($this->tagName, self::VOID_ELEMENTS)) {
      parent::display();
      echo "</$this->tagName>";
    }
    foreach ($this->scripts as $script)
      $script->display();
  }

  // Accept a script element that gets displayed after the subject
  // element
  function addScript(?Script $script=null)
  {
    if ($script == null)
      $script = new Script();
    $this->scripts[] = $script;
    return $script;
  }
  
  //-----------------------------------

  function __get($p)
  {
    switch ($p) {
      case "id":
        if (array_key_exists($p, $this->attributes))
          return $this->attributes[$p];
        else
          return null;
      default:
        throw new \LogicException("Property '$p' not supported");
    }
  }

  //-----------------------------------

  function __set($p, $v)
  {
    switch ($p) {
      case "id":
        $this->attributes[$p] = $v;
        break;
      default:
        throw new \LogicException("Property '$p' not supported");
    }
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2017 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
