<?php 
// PHP program to sort array of dates  
  
// user-defined comparison function  
// based on timestamp 
function compareByTimeStamp($time1, $time2) 
{ 
    if (strtotime($time1) < strtotime($time2)) 
        return 1; 
    else if (strtotime($time1) > strtotime($time2))  
        return -1; 
    else
        return 0; 
} 
  
// Input Array 
$arr = array("2016-09-12", "2009-09-06", "2009-09-09"); 
  
// sort array with given user-defined function 
usort($arr, "compareByTimeStamp"); 
  
print_r($arr); 
  
?> 