<?php

  namespace BB\custom\engine;

  if(@secure !== true)
    die('forbidden');

  class simpleObjects extends \BB\engine {

    protected $path = 'custom/extension/simpleObject1.0/';

    /**
     * @access public
     * @return string
     */
    public function viewStartTeaser(){

    }

  }

?>