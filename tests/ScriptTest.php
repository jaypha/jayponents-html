<?php
//----------------------------------------------------------------------------
//
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use PHPUnit\Framework\TestCase;

class ScriptTest extends TestCase
{
  function testConstuct()
  {
    $e = new Script();
    $this->assertEquals($e, "<script></script>");
  }

  function testAttributes()
  {
    $e = new Script();
    $e->defer = true;
    $e->nonce = "abcdefg";
    $e->nomodule = false;
    $e->async = "123";

    $this->assertTrue($e->defer);
    $this->assertTrue($e->async);
    $this->assertFalse($e->nomodule);

    $this->assertEquals($e->nonce, "abcdefg");

    $this->assertEquals($e->__toString(), "<script defer nonce='abcdefg' async></script>");
  }
}


//----------------------------------------------------------------------------
// Copyright (C) 2019 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
