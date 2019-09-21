<?php
//----------------------------------------------------------------------------
//
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;


class Script extends Element
{
  function __construct()
  {
    parent::__construct("script");
  }

  function __get($p)
  {
    switch ($p) {
      case "async":
      case "defer":
      case "nomodule":
        return $this->attributes[$p] ?? false;
        break;
      case "nonce":
      case "type":
      case "src":
      case "integrity":
      case "referrerpolicy":
        return $this->attributes[$p] ?? null;
      default:
        return parent::__get($p);
    }
  }

  //-----------------------------------

  function __set($p, $v)
  {
    switch ($p) {
      case "async":
      case "defer":
      case "nomodule":
        $this->attributes[$p] = (bool) $v;
        break;
      case "nonce":
      case "type":
      case "src":
      case "integrity":
      case "referrerpolicy":
        $this->attributes[$p] = $v;
        break;
      default:
        return parent::__set($p, $v);
    }
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2019 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//

