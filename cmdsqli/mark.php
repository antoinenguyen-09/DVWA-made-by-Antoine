<?php
echo "This student 's mark is:\n"; 
$output = shell_exec('python3 gen_mark.py '.$_GET['studentID'].' '.$_GET['classID']);
echo "<pre>$output</pre>";
?>
