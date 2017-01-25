<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';
// pour debugguer plus facile;ent
date_default_timezone_set(UTC);
ini_set('display_errors', 1);

print( Vertex::doc() );
Color::$verbose = True;
Vertex::$verbose = True;

$vtxO  = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
print( $vtxO  . PHP_EOL );

$red   = new Color( array( 'red' => 255, 'green' =>   0, 'blue' =>   0 ) );
print( $red  . PHP_EOL );
$vtx1  = new Vertex( array( 'x' => 1.0, 'y' => 2.0, 'z' => 3.0, 'w' => '4.0', 'color' => $red ) );
?>
