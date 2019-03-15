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

/*
  function testCssOld()
  {
    $x = new Head();
    $x->cssFiles[] = "style.css";
    $x->cssFiles[] = [ "href" => "stiff.css", "min" => "max" ];
    $x->cssText[] = ".s { margin: 2px; }";
    $x->cssText[] = ".g { margin: 3px; }";
    $this->assertEquals($x, "<head><title></title><link rel='stylesheet' href='style.css'><link rel='stylesheet' href='stiff.css' min='max'><style>.s { margin: 2px; }.g { margin: 3px; }</style></head>");
  }
*/

  function testCss()
  {
    $x = new Head();
    $x->addStylesheet("style.css");
    $sheet = $x->addStylesheet("stiff.css");
    $sheet->attributes["title"] = "Default";
    $style = $x->addStyleTag();
    $style->add(".s { margin: 2px; }");
    $style->add(".g { margin: 3px; }");
    $this->assertEquals($x->__toString(), "<head><title></title><link rel='stylesheet' href='style.css'><link rel='stylesheet' href='stiff.css' title='Default'><style>.s { margin: 2px; }.g { margin: 3px; }</style></head>");
  }

/*
  function testScriptOld()
  {
    $x = new Head();
    $x->scriptFiles[] = "aoe.js";
    $x->scriptFiles[] = [ "src"=>"min.js", "type"=>"text/javascript" ];
    $x->scriptText[] = "var x='y';";
    $x->scriptText[] = "tui();";
    $this->assertEquals($x, "<head><title></title><script src='aoe.js'></script><script src='min.js' type='text/javascript'></script><script>var x='y';tui();</script></head>");
  }
*/

  function testScript()
  {
    $x = new Head();
    $x->addScriptTag("aoe.js");
    $x->addScriptTag("min.js", true);
    $src = $x->addScriptTag();
    $src->attributes["nonce"] = "abc";
    $src->add("var x='y';");
    $src->add("tui();");
    $this->assertEquals($x, "<head><title></title><script src='aoe.js'></script><script src='min.js' type='module'></script><script nonce='abc'>var x='y';tui();</script></head>");
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
    $mt = $x->addMetaTag();
    $mt->attributes["content"] = "bequ";
    $mt->attributes["charset"] = "tax";
    $this->assertEquals($x, "<head><title></title><meta name='a' content='b'><meta name='fa' content='be' httpEquiv='x'><meta name='fab' content='beq' charset='ax'><meta content='bequ' charset='tax'></head>");
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2018 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
