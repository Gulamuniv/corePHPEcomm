<?php 
$name =array(
         'a'=>2,
         'b' =>3,
          'c'=>7,
          'd'=>4

);
$arr  =array_change_key_case($name,CASE_UPPER);
print_r($arr);
?>