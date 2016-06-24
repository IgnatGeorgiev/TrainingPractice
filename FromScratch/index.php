<?php
  define( 'DX_ROOT_DIR', dirname(__FILE__). '/');
  define('DX_ROOT_PATH', basename(dirname(__FILE__)). '/');
  $request = $_SERVER['REQUEST_URI'];
  $controller = 'master';
  $method = 'index';
  $param = array();
  $request_home = '/' . DX_ROOT_PATH;
  include_once 'controllers/master.php';
  if(!empty($request)) {
    if(0 === strpos($request, '/' . DX_ROOT_PATH)) {
      $request = substr($request, strlen($request_home));
      $components = explode('/', $request, 3);
      if(1 < count($components)) {
        list($controller, $method)  = $components;
        if (isset($components[2])) {
          $param = $components[2];
        }
        include_once 'controllers/'.$controller.'.php';
      }
    }
  }


$controller_class = '\controllers\\'.$controller;
$instance  = new $controller_class();
if (method_exists($instance, $method)) {
  call_user_func_array(array($instance,$method), array($param));
}
 ?>
