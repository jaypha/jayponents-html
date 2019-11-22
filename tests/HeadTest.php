<?php
//----------------------------------------------------------------------------
//
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use PHPUnit\Framework\TestCase;

class HeadTest extends TestCase
{
  //---------------------------------------------

  function testEmpty()
  {
    $x = new Head();
    $this->assertEquals("<head><title></title></head>", $x->__toString());
  }

  //---------------------------------------------

  function testTitle()
  {
    $x = new Head();
    $x->title = "A Title";
    $this->assertEquals("<head><title>A Title</title></head>", $x->__toString());
  }

  //---------------------------------------------

  function testCss()
  {
    $x = new Head();
    $x->addStylesheet("style.css");
    $sheet = $x->addStylesheet("stiff.css");
    $sheet->attributes["title"] = "Default";
    $style = $x->addStyleTag();
    $style->add(".s { margin: 2px; }");
    $style->add(".g { margin: 3px; }");
    $this->assertEquals("<head><title></title><link rel='stylesheet' href='style.css'><link rel='stylesheet' href='stiff.css' title='Default'><style>.s { margin: 2px; }.g { margin: 3px; }</style></head>", $x->__toString());
  }

  //---------------------------------------------

  function testScript()
  {
    $x = new Head();
    $x->addScriptTag("aoe.js");
    $x->addScriptTag("min.js", true);
    $src = $x->addScriptTag();
    $src->nonce = "abc";
    $src->add("var x='y';");
    $src->add("tui();");
    $this->assertEquals("<head><title></title><script src='aoe.js'></script><script src='min.js' type='module'></script><script nonce='abc'>var x='y';tui();</script></head>", $x);
  }

  //---------------------------------------------

  function testMetaTag()
  {
    $x = new Head();
    $x->addMetaTag("a", "b");
    $this->assertEquals("<head><title></title><meta name='a' content='b'></head>", $x);
    $x->addMetaTag("fa", "be", "x");
    $this->assertEquals("<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'></head>", $x);
    $x->addMetaTag("fab", "beq", null, "ax");
    $this->assertEquals("<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'><meta name='fab' content='beq' charset='ax'></head>", $x);
    $mt = $x->addMetaTag();
    $mt->attributes["content"] = "bequ";
    $mt->attributes["charset"] = "tax";
    $this->assertEquals("<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'><meta name='fab' content='beq' charset='ax'><meta content='bequ' charset='tax'></head>", $x);
  }

  //---------------------------------------------

  function testBase()
  {
    $x = new Head();
    $x->addBaseTag("xxx", "yyy");
    $this->assertEquals("<head><title></title><base href='xxx' target='yyy'></head>", $x->__toString());
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2018 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
