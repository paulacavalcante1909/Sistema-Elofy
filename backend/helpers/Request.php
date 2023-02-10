<?php

class Request
{
    public static function getPostParam($key = '')
    {
      if (!isset($_POST) || empty($_POST) || !is_array($_POST)) {
        return false;
      }
      $_POST = (array) $_POST;
      if (isset($_POST[$key])) {
        return addslashes(strip_tags(trim($_POST[$key])));
      }
      return false;
    }

}
