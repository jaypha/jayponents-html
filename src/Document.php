<?php
//----------------------------------------------------------------------------
// Functions for building commonly used HTML elements.
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

class Document
{
  public $head; // Head
  public $body; // Element

  public $attributes = [];
 
  public $currentForm;

  public $comment = null;

  //-----------------------------------

  function __construct(string $pageId = null)
  {
    $this->head = new Head();
    $this->body = new Element("body");
    $this->attributes["lang"] = "en";
    if ($pageId)
      $this->pageId = $pageId;
  }

  //-----------------------------------

  function display()
  {
//    $body = $this->body->__toString();
//    $head = $this->head->__toString();

    echo "<!DOCTYPE html>";
    echo "<html ";
    if (count($this->attributes)) {
      foreach ($this->attributes as $k => $v) {
        echo " $k";
        if ($v !== null)
          echo "='",htmlspecialchars($v, ENT_QUOTES|ENT_HTML5),"'";
      }
    }
    echo ">";

    if ($this->comment)
      echo "<!-- $comment -->";

    $this->head->display();
    $this->body->display();
    echo "</html>";
  }

  //-----------------------------------

  function __toString() {
    ob_start();
    $this->display();
    return ob_get_clean();
  }

  //-----------------------------------

  function __get($p)
  {
    switch ($p)
    {
      case "pageId":
        return $this->body->id;
      case "title":
        return $this->head->title;
      case "language":
        return $this->lang;
        break;
      case "lang":
      case "manifest":
        if (array_key_exists($p, $this->attributes))
          return $this->attributes[$p];
        else
          return null;
    }
  }

  //-----------------------------------

  function __set($p, $v)
  {
    switch ($p)
    {
      case "pageId":
        $this->body->id = $v;
        break;
      case "title":
        $this->head->title = $v;
        break;
      case "language":
        $this->attributes["lang"] = $v;
        break;
      case "lang":
      case "manifest":
        $this->attributes[$p] = $v;
        break;
    }
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2017 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
