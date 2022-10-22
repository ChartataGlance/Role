<?php
$routes =[];
route('/home', function(){
  echo "./public/index.html";
});

route('/login', function(){
   echo "login page";
});
route('/login', function(){
   echo "login page";
});

function route(string $path, callable $callback){
   global $routes;
   $routes[$path] = $callback;
}

run();
function run(){
   global $routes;
   $uri = $_SERVER['REQUEST_URI'];
   foreach($routes as $path => $callback){
      if($path !== $uri) continue ;
      $callback();
   }
};
