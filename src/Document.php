<?php
//----------------------------------------------------------------------------
// Functions for building commonly used HTML elements.
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

class Document extends Element
{
  public $head; // Head
  public $body; // Element

  public $comment = null;

  //-----------------------------------

  function __construct(string $pageId = null)
  {
    parent::__construct("html");
    $this->head = new Head();
    $this->body = new Element("body");
    $this->attributes["lang"] = "en";
    if ($pageId)
      $this->pageId = $pageId;
  }

  //-----------------------------------

  function display()
  {
    echo "<!DOCTYPE html>";
    parent::display();
  }

  function displayInner()
  {
    if ($this->comment)
      echo "<!-- $this->comment -->";

    $this->head->display();
    $this->body->display();
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
      case "lang":
        return $this->attributes["lang"];
        break;
      case "manifest":
        trigger_error("HTML manifest is deprecated", E_USER_DEPRECATED);
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
      case "lang":
        $this->attributes["lang"] = $v;
        break;
      case "manifest":
        trigger_error("HTML manifest is deprecated", E_USER_DEPRECATED);
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
