[<?php echo $result ?>, <?php 
 echo '[';
 if ($result != 0) {
   $len = count($errorList);
   foreach ($errorList as $err) {
     echo '"', $err, '"';
     if ($len != 1)
       echo ',';
     $len--;
   }
 } else {
   $len = count($renderImages);
   foreach ($renderImages as $img) {
     echo '"', $img, '"';
     if ($len != 1)
       echo ',';
     $len--;
   }   
 }
 echo ']';
?>]