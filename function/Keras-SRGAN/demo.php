<?php

ob_start();

//Check we have access to the command line.
// echo exec("ping google.com -n 1");
$a= passthru('C:\Users\lenovo\AppData\Local\Programs\Python\Python36\python.exe loo.py');
// sleep(3);
echo '<pre>'.$a.'</pre>';
// shell_exec('start calc');

//Capture the output.
$output = ob_get_clean();

//Let's display it.
echo $output;

// echo exec('C:\Users\lenovo\AppData\Local\Programs\Python\Python36\python.exe F:\wamp\www\super-res\Keras-SRGAN\test.py');
?>