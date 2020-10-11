<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf( STDIN, "%d",
    $N
);
$input = str_split( str_replace( " ", "", stream_get_line( STDIN, 30 + 1, "\n" ) ) );

if( in_array( "-", $input ) ) {
    if( in_array( ".", $input ) ) {
        if( ( $key = array_search( "-", $input ) ) !== FALSE ) {
            unset( $input[ $key ] );

        }
        if( ( $key = array_search( ".", $input ) ) !== FALSE ) {
            unset( $input[ $key ] );
        }
        usort( $input, function( $a, $b ) { //croissant
            return $a - $b;
        } );

        $result = ["-"];
        $result[] = array_shift( $input );
        $result[] = ".";
        while( !empty( $input ) ) {
            $result[] = array_shift( $input );
        }
    } else {
        if( ( $key = array_search( "-", $input ) ) !== FALSE ) {
            unset( $input[ $key ] );

        }
        if( ( $key = array_search( ".", $input ) ) !== FALSE ) {
            unset( $input[ $key ] );
        }
        usort( $input, function( $a, $b ) { //croissant
            return $a - $b;
        } );

        $result = ["-"];
        while( !empty( $input ) ) {
            $result[] = array_shift( $input );
        }
    }
} else {
    if( in_array( ".", $input ) ) {
        if( ( $key = array_search( ".", $input ) ) !== FALSE ) {
            unset( $input[ $key ] );
        }
        usort( $input, function( $a, $b ) { // decroissant
            return $b - $a;
        } );

        $result = [];
        while( sizeof( $input ) > 1 ) {
            $result[] = array_shift( $input );
        }
        $result[] = ".";
        $result[] = array_shift( $input );
    } else {
        usort( $input, function( $a, $b ) { // decroissant
            return $b - $a;
        } );
        $result = [""];
        while( !empty( $input ) ) {
            $result[] = array_shift( $input );
        }
    }
}
error_log( var_export( $result, TRUE ) );
if(end($result) == "0") {
    if( ( $key = array_search( ".", $result ) ) !== FALSE ) {
        unset( $result[ $key ] );
    }

    array_pop($result);
}

$return = "";
$zero = true;
foreach( $result as $r)
{
    $return .= $r;
    if($r != "0" && $r != "-" && $r != "."){
        $zero = false;
    }
}

if($zero){
    $return = 0 ;
}
echo( "{$return}\n" );
//error_log( var_export( $return, TRUE ) );


// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));
//usort( $input, function( $a, $b ) { //croissant
//    return $a - $b;
//} );
//
//error_log(var_export($input, true));
//
//usort( $input, function( $a, $b ) { // decroissant
//    return $b - $a;
//} );
//
//error_log(var_export($input, true));
//echo("greatest\n");


?>