<?php
  namespace Xtroo\Test;

  use Xtroo\Xtroo;
  use PHPUnit\Framework\TestCase;

  class XtrooTest extends TestCase
  {
    public function testInstantiation()
    {
      $Object = new Xtroo('testing');
      $this->assertInstanceOf('Xtroo\Xtroo', $Object);

      $this->assertEquals('testing', $Object->getToken());
    }

    public function testFailInstantiation()
    {
      $this->expectException('\Xtroo\Exceptions\XtrooException');
      new Xtroo();
    }
  }