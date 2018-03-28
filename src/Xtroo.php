<?php

  namespace Xtroo;

  use Xtroo\Exceptions\XtrooException;


  /**
   * Class Xtroo
   *
   * The main API class
   *
   * @package Xtroo
   */
  class Xtroo
  {
    protected $token = null;

    function __construct($token = null)
    {
      if ($token == null)
        throw new XtrooException('Missing Token, please set API Token');

      $this->token = $token;
    }

    public function getToken()
    {
      return $this->token;
    }
  }