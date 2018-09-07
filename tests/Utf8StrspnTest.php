<?php

declare(strict_types=1);

use voku\helper\UTF8 as u;

/**
 * Class Utf8StrspnTest
 */
class Utf8StrspnTest extends \PHPUnit\Framework\TestCase
{
  public function test_match()
  {
    $str = 'iñtërnâtiônàlizætiøn';

    self::assertSame(1, u::strspn($str, 'i'));
    self::assertSame(0, u::strspn($str, 'â'));
    self::assertSame(0, u::strspn($str, 'âë'));
    self::assertSame(3, u::strspn($str, 'itñ'));
    self::assertSame(3, u::strspn($str, 'iñt'));
    self::assertSame(11, u::strspn($str, 'âëiônñrt'));
  }

  public function test_no_charlist()
  {
    $str = 'iñtërnâtiônàlizætiøn';
    self::assertSame(0, u::strspn($str, ''));
  }

  public function test_empty_input()
  {
    $str = '';
    self::assertSame(0, u::strspn($str, "\n"));
  }

  public function test_match_two()
  {
    $str = 'iñtërnâtiônàlizætiøn';
    self::assertSame(4, u::strspn($str, 'iñtë'));
  }

  public function test_compare_strspn()
  {
    $str = 'aeioustr';
    self::assertSame(strspn($str, 'saeiou'), u::strspn($str, 'saeiou'));
  }

  public function test_match_ascii()
  {
    $str = 'internationalization';
    self::assertSame(strspn($str, 'aeionrt'), u::strspn($str, 'aeionrt'));
  }

  public function test_max_length()
  {
    $str = "iñtërnât\niônàlizætiøn";
    self::assertSame(5, u::strspn($str, 'âëiônñrt', 0, 5));
  }

  public function test_offset()
  {
    $str = "iñtërnât\niônàlizætiøn";
    self::assertSame(5, u::strspn($str, 'âëiônñrt', 1, 5));
  }

  public function test_linefeed()
  {
    $str = "iñtërnât\niônàlizætiøn";
    self::assertSame(8, u::strspn($str, 'âëiônñrt'));
  }

  public function test_linefeed_mask()
  {
    $str = "iñtërnât\niônàlizætiøn";
    self::assertSame(12, u::strspn($str, "âëiônñrt\n"));
  }
}
