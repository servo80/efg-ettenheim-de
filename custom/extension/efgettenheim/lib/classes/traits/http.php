<?php

  namespace BB\custom\extension\efgettenheim\lib\classes\traits {

    /**
     *
     */
    trait http {

      /**
       * @param $key
       *
       * @return array
       */
      public function getArray($key) {
        return $this->getHttp()->getArray($key);
      }

      /**
       * @param $key
       *
       * @return boolean
       */
      public function getBoolean($key) {
        return $this->getHttp()->getBoolean($key);
      }

      /**
       * @param $key
       *
       * @return array
       */
      public function getFile($key) {
        return $this->getHttp()->getFile($key);
      }

      /**
       * @param $key
       *
       * @return array
       */
      public function getFileName($key) {
        return $this->getHttp()->getFileName($key);
      }

      /**
       * @param $key
       *
       * @return float
       */
      public function getFloat($key) {
        return $this->getHttp()->getFloat($key);
      }

      /**
       * @return \BB\request\http
       */
      public function getHttp() {
        return \BB\request\http::get();
      }

      /**
       * @param $key
       *
       * @return integer
       */
      public function getInteger($key) {
        return $this->getHttp()->getInteger($key);
      }

      /**
       * @param $key
       *
       * @return object
       */
      public function getObject($key) {
        return $this->getHttp()->getObject($key);
      }

      /**
       * @param string $key
       * @return mixed
       */
      public function getParam($key) {
        return $this->getHttp()->getParam($key);
      }

      /**
       * @return array
       */
      public function getParams() {
        return $this->getHttp()->getParams();
      }

      /**
       * @return array
       */
      public function getPostParams() {
        return $this->getHttp()->getPostParams();
      }

      /**
       * @param $key
       *
       * @return string
       */
      public function getString($key) {
        return $this->getHttp()->getString($key);
      }

      /**
       * @return array
       */
      public function isAjax() {
        return $this->getHttp()->isAjax();
      }

      /**
       * @param $key
       *
       * @return float
       */
      public function issetParam($key) {
        return $this->getHttp()->issetParam($key);
      }

      /**
       * @param $key
       * @param $path
       * @param $filename
       *
       * @return boolean
       */
      public function moveFileTo($key, $path, $filename) {
        return $this->getHttp()->moveFileTo($key, $path, $filename);
      }
    }
  }

?>