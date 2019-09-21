<?php
//----------------------------------------------------------------------------
// Functions for building commonly used HTML elements.
//----------------------------------------------------------------------------

namespace Jaypha\Jayponents\Html;

//-----------------------------------------------------------------------------

function hidden(string $name, $value)
{
  return "<input type='hidden' name='$name' value='".htmlspecialchars($value, ENT_QUOTES|ENT_HTML5)."'/>";
}

//-----------------------------------------------------------------------------

function truncated_text(string $text, int $length)
{
  assert($length >= 2);
  if (strlen($text) <= $length) return $text;
  else
  {
    return "<span title='$text'>".substr($text,0,$length-2)."..</span>";
  }
}

//-----------------------------------------------------------------------------

function nl2br(string $text)
{
  return str_replace("\n", "<br/>", $text);
}

//-----------------------------------------------------------------------------

function link(string $link, string $label = null, bool $newPage = false)
{
  return "<a href='$link'".($newPage?" target='_blank'":"").">".($label ?? $link)."</a>";
}

//-----------------------------------------------------------------------------

function javascript(string $script)
{
  return "<script>$script</script>";
}

function script(string $script, $mimeType = null)
{
  return "<script".($mimeType?" type='$mimeType'":"").">$script</script>";
}

//-----------------------------------------------------------------------------

function img(string $src, string $alt, string $cssClass = null, string $id = null)
{
  return "<img src='$src' alt='$alt'".
         ($cssClass ? " class='$cssClass'":"").
         ($id?" id='$id'":"")."/>";
}

//-----------------------------------------------------------------------------

function make_nb(string $src)
{
  return str_replace(" ", "&nbsp;", $src);
}

//-----------------------------------------------------------------------------

function element(string $tagName, array $attributes, string $content = null)
{
  $s = "<$tagName";
  foreach ($attributes as $n =>$v)
  {
    if (is_int($n))
      $s .= " $v";
    else
    {
      $s .= " $n";
      if ($v !== null)
        $s .= "='".htmlspecialchars($v, ENT_QUOTES|ENT_HTML5)."'";
    }
  }
  $s .= ">";
  if (!in_array($tagName, Element::VOID_ELEMENTS))
    $s .= "$content</$tagName>";
  return $s;
}

//----------------------------------------------------------------------------

function comment(string $comment)
{
  return "<!-- $comment -->";
}

//----------------------------------------------------------------------------
// Copyright (C) 2017 Jaypha.
// License: BSL-1.0
// Author: Jason den Dulk
//
