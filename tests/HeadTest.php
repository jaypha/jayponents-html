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
    $this->assertEquals($x, "<head><title></title></head>");
  }

  //---------------------------------------------

  function testTitle()
  {
    $x = new Head();
    $x->title = "A Title";
    $this->assertEquals($x, "<head><title>A Title</title></head>");
  }

  //---------------------------------------------

  function testCss()
  {
    $x = new Head();
    $x->cssFiles[] = "style.css";
    $x->cssFiles[] = [ "href" => "stiff.css", "min" => "max" ];
    $x->cssText[] = ".s { margin: 2px; }";
    $x->cssText[] = ".g { margin: 3px; }";
    $this->assertEquals($x, "<head><title></title><link rel='stylesheet' type='text/css' href='style.css'><link rel='stylesheet' type='text/css' href='stiff.css' min='max'><style type='text/css'>.s { margin: 2px; }.g { margin: 3px; }</style></head>");
  }

  function testScript()
  {
    $x = new Head();
    $x->scriptFiles[] = "aoe.js";
    $x->scriptFiles[] = [ "src"=>"min.js", "type"=>"text/javascript" ];
    $x->scriptText[] = "var x='y';";
    $x->scriptText[] = "tui();";
    $this->assertEquals($x, "<head><title></title><script src='aoe.js'></script><script src='min.js' type='text/javascript'></script><script type='text/javascript'>var x='y';tui();</script></head>");
  }

  function testMetaTag()
  {
    $x = new Head();
    $x->addMetaTag("a", "b");
    $this->assertEquals($x, "<head><title></title><meta name='a' content='b'></head>");
    $x->addMetaTag("fa", "be", "x");
    $this->assertEquals($x, "<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'></head>");
    $x->addMetaTag("fab", "beq", null, "ax");
    $this->assertEquals($x, "<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'><meta name='fab' content='beq' charset='ax'></head>");
    $x->addMetaTag("faeb", "bequ", "p", "tax");
    $this->assertEquals($x, "<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'><meta name='fab' content='beq' charset='ax'><meta name='faeb' content='bequ' httpEquiv='p' charset='tax'></head>");
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2018 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
