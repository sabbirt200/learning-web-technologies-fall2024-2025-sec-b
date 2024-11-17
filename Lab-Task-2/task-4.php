<?php
    $a = 3;
    $b = 4;
    $c = 5;
 
    if($a > $b)
    {
        if($a > $c)
        {
            echo $a. " the largest<br>";
        }
        else
        {
            echo $b. " the largest<br>";
        }
    }
    else
    {
        if($b > $c)
        {
            echo $b. " the largest<br>";
        }
        else
        {
            echo $c. " the largest<br>";
        }
    }
?>