<?php
//----------------------------------------------------------------------------
// Unit test for Element
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
  function testConstruct()
  {
    $e = new Element();
    $this->assertEquals($e, "<div></div>");
    $e = new Element("form");
    $this->assertEquals($e, "<form></form>");
    $e = new Element("img");
    $this->assertEquals($e, "<img>");
    $e = new Element("form");
    $e->setTemplate(__DIR__."/simple.tpl");
    $this->assertEquals($e, "<form>Simple Content\n</form>");
  }

  function testAttributes()
  {
    $x = new Element();
    $x->attributes["dig"] = "mill'bourne";
    $x->attributes["mix"] = true;
    $x->attributes["null"] = null;
    $x->attributes["absent"] = false;
    $x->tagName = "p";
    $x->id = "filly";
    $x->cssClasses[] = "some-class";
    $x->cssClasses[] = "another-class";
    $x->cssStyles["margin"] = "2px";
    $x->cssStyles["padding"] = "3px";
    $this->assertEquals($x, "<p class='some-class another-class' dig='mill&apos;bourne' mix id='filly' style='margin:2px;padding:3px;'></p>");
    $this->assertEquals($x->id, "filly");
  }

  function testScript()
  {
    $x = new Element();
    $s = $x->addScript();
    $s->add("xxx");
    $s2 = new Script();
    $s2->nonce = "123";
    $x->addScript($s2);
    $this->assertEquals($x->__toString(), "<div></div><script>xxx</script><script nonce='123'></script>");
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2018 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
