<?php

/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
class Utilities
{
    public function getGo( $moves, $field, $myPosition )
    {
        $return = NULL;
        $possibilities = [];

        foreach( $moves as $move ) {
            $explodedMove = explode( " ", $move );

            $nextPos = $this->convertMoveToPosition( $explodedMove[ 2 ], $myPosition[ $explodedMove[ 1 ] ] );
            $currentLevel = $this->getPositionLevel( $field, $myPosition[ $explodedMove[ 1 ] ] );
            $nextPosLevel = $this->getPositionLevel( $field, $nextPos );
            $buildHeigh = $this->convertMoveToBuildHeigh( $field, $explodedMove[ 3 ], $nextPos );


            $score = $this->calculateScore( $currentLevel, $nextPosLevel, $buildHeigh, $explodedMove[ 1 ], $explodedMove[ 0 ] );

            $possibilities[] = [
                "score"        => $score,
                "move"         => $move,
                "currentLevel" => $currentLevel,
                "nextLevel"    => $nextPosLevel,
                //                    "currentPos" =>$myPosition,
                //                    "nextPos" => $nextPos,
                //                    "buildHeigh" => $buildHeigh,
            ];
        }
        usort( $possibilities, function( $a, $b ) {
            return $a[ 'score' ] - $b[ 'score' ];
        } );
        error_log( var_export( $possibilities, TRUE ) );

        if( !empty( $possibilities ) ) {
            $return = end( $possibilities )[ "move" ];
        }

        return $return;


    }

    public function calculateScore( $currentPosLevel, $nextPosLevel, $buildHeigh, $unit, $action )
    {

//        current ARENA
        $score = $nextPosLevel * 100;
        ( ( $buildHeigh == 4 ) || ( $buildHeigh >= $currentPosLevel + 2 ) ) ? $score -= 100 : $score += $buildHeigh * 10;
        $score -= $unit;


        return $score;
    }

    public function sortingPossibilities( $a, $b )
    {
        return $a[ 'score' ] - $b[ 'score' ];
    }

    public function convertMoveToBuildHeigh( $field, $build, $position )
    {
        switch( $build ) {
            case "N": // Y-1
                $buildUp = [
                    $position[ 0 ],
                    $position[ 1 ] - 1,
                ];
                break;
            case "NE": // Y-1 | X+1
                $buildUp = [
                    $position[ 0 ] + 1,
                    $position[ 1 ] - 1,
                ];
                break;
            case "E" : // X+1
                $buildUp = [
                    $position[ 0 ] + 1,
                    $position[ 1 ],
                ];

                break;
            case "SE": // Y+1 | X+1
                $buildUp = [
                    $position[ 0 ] + 1,
                    $position[ 1 ] + 1,
                ];

                break;
            case "S": // Y+1
                $buildUp = [
                    $position[ 0 ],
                    $position[ 1 ] + 1,
                ];

                break;
            case "SW": // Y+1 | X-1
                $buildUp = [
                    $position[ 0 ] - 1,
                    $position[ 1 ] + 1,
                ];

                break;
            case "W": // X-1
                $buildUp = [
                    $position[ 0 ] - 1,
                    $position[ 1 ],
                ];

                break;
            case "NW" : // Y-1 | X-1
                $buildUp = [
                    $position[ 0 ] - 1,
                    $position[ 1 ] - 1,
                ];
                break;
        }


        return $this->getPositionLevel( $field, $buildUp ) + 1;
    }

    public function convertMoveToPosition( $nextCaseDirection, $myPosition )
    {
        switch( $nextCaseDirection ) {
            case "N": // Y-1
                $nextCase = [
                    $myPosition[ 0 ],
                    $myPosition[ 1 ] - 1,
                ];
                break;
            case "NE": // Y-1 | X+1
                $nextCase = [
                    $myPosition[ 0 ] + 1,
                    $myPosition[ 1 ] - 1,
                ];
                break;
            case "E" : // X+1
                $nextCase = [
                    $myPosition[ 0 ] + 1,
                    $myPosition[ 1 ],
                ];

                break;
            case "SE": // Y+1 | X+1
                $nextCase = [
                    $myPosition[ 0 ] + 1,
                    $myPosition[ 1 ] + 1,
                ];

                break;
            case "S": // Y+1
                $nextCase = [
                    $myPosition[ 0 ],
                    $myPosition[ 1 ] + 1,
                ];

                break;
            case "SW": // Y+1 | X-1
                $nextCase = [
                    $myPosition[ 0 ] - 1,
                    $myPosition[ 1 ] + 1,
                ];

                break;
            case "W": // X-1
                $nextCase = [
                    $myPosition[ 0 ] - 1,
                    $myPosition[ 1 ],
                ];

                break;
            case "NW" : // Y-1 | X-1
                $nextCase = [
                    $myPosition[ 0 ] - 1,
                    $myPosition[ 1 ] - 1,
                ];
                break;
        }

        return $nextCase;
    }

    public function getPositionLevel( $field, $position )
    {

        return (int) $field[ $position[ 1 ] ][ $position[ 0 ] ];
    }

}

fscanf( STDIN, "%d", $size );
fscanf( STDIN, "%d", $unitsPerPlayer );

// game loop
while( TRUE ) {
    $myUnit = [];
    $ennemyUnit = [];
    $moves = [];
    $field = [];

    $utilities = new Utilities();


    for( $i = 0; $i < $size; $i++ ) {
        fscanf( STDIN, "%s", $row );

        $field[] = str_split( $row );
//        error_log( var_export( $row, TRUE ) );
    }
//    error_log( var_export( $field, TRUE ) );
    for( $i = 0; $i < $unitsPerPlayer; $i++ ) {
        fscanf( STDIN, "%d %d", $unitX, $unitY );
        $myUnit[] = [
            $unitX,
            $unitY,
        ];
    }
    for( $i = 0; $i < $unitsPerPlayer; $i++ ) {
        fscanf( STDIN, "%d %d", $otherX, $otherY );
        $ennemyUnit[] = [
            $otherX,
            $otherY,
        ];
    }
    // error_log( var_export( $ennemyUnit, TRUE ) );
    fscanf( STDIN, "%d", $legalActions );
    error_log( var_export( "Possible Actions : {$legalActions}", TRUE ) );
    for( $i = 0; $i < $legalActions; $i++ ) {
        fscanf( STDIN, "%s %d %s %s", $atype, $index, $dir1, $dir2 );

        $moves[] = "{$atype} {$index} {$dir1} {$dir2}";
    }


    if( $legalActions > 0 ) {
//        foreach( $myUnit as $pos ) {
        $go = $utilities->getGo( $moves, $field, $myUnit );
//        }
        if( is_null( $go ) ) {
            $go = $moves[ array_rand( $moves, 1 ) ];
        }
        echo( "{$go}\n" );
    } else {
        echo( "ACCEPT-DEFEAT Well done!\n" );
    }

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));


    // improvement : add the # of adjacent reachables cases to the decision score
    // improvement : dont let the second unit be blocked
    // improvement : use the field info  to "disable" the fog of war
    // improvement : handle the Kick function
    // improvement : make a graph for the "blocking kicks"

}
?>