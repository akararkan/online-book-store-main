<?php  

# Form validation function
function is_empty($var, $text, $location, $ms, $data){
   if (empty($var)) {
   	 # Error message
   	 $em = "ئەم ".$text." پێویستە";
   	 header("Location: $location?$ms=$em&$data");
   	 exit;
   }
   return 0;
}