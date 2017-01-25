<?php

require_once 'Color.class.php';


print( Color::doc() );
Color::$verbose = True;

$red     = new Color( array( 'red' => 0xff, 'green' => -42   , 'blue' => 260    ) );
print($red);
?>
