<?php
//----------------------------------------------------------------------------
//
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
  function testEmpty()
  {
    $x = new Document();
    $this->AssertEquals($x,"<!DOCTYPE html><html lang='en'><head><title></title></head><body></body></html>");
  }

  function testAttributes()
  {
    $x = new Document("pageOne");
    $this->AssertEquals($x,"<!DOCTYPE html><html lang='en'><head><title></title></head><body id='pageOne'></body></html>");
    $x->pageId = "pageTwo";
    $x->title = "Page Two";
    $this->AssertEquals($x,"<!DOCTYPE html><html lang='en'><head><title>Page Two</title></head><body id='pageTwo'></body></html>");
    $x->lang = "fr";
    $this->AssertEquals($x,"<!DOCTYPE html><html lang='fr'><head><title>Page Two</title></head><body id='pageTwo'></body></html>");
  }

  function testBody()
  {
    $x = new Document();
    $x->body->add("<h1>Title</h1>");
    $this->AssertEquals($x,"<!DOCTYPE html><html lang='en'><head><title></title></head><body><h1>Title</h1></body></html>");
  }

  function testComment()
  {
    $x = new Document();
    $x->comment = "A Comment";
    $this->AssertEquals($x,"<!DOCTYPE html><html lang='en'><!-- A Comment --><head><title></title></head><body></body></html>");
  }
}

//----------------------------------------------------------------------------
// Copyright (C) 2018 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
