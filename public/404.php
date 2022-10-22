<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <h1>404
   CREATE TABLE `u333044244_chartataglance`.`veryfiedusers`
   (`id` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(60) NOT NULL ,
    `pass` VARCHAR(256) NOT NULL ,
    `email` VARCHAR(60) NOT NULL , 
    `verified` TINYINT(1) NOT NULL,
    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`))
   </h1>
</body>
</html>
ALTER TABLE `veryfiedusers` ADD `vkey` VARCHAR NOT NULL AFTER `email`;