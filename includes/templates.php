<?php

//$data = array() provides $data a black array incase nothing is passed
//extract() converts key values into variables
function render($template, $data = array())
{
    $path = "../templates/" . $template . ".php";
    if(file_exists($path))
    {
        extract($data);
        require($path);
    }
}

?>