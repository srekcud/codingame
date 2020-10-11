<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $N // Number of elements which make up the association table.
);
fscanf(STDIN, "%d",
    $Q // Number Q of file names to be analyzed.
);
$refTypes = [];
$unknowTypes = [] ;
for ($i = 0; $i < $N; $i++)
{
    fscanf(STDIN, "%s %s",
        $EXT, // file extension
        $MT // MIME type.
    );
    $refTypes[strtolower($EXT)] = $MT;
}
for ($i = 0; $i < $Q; $i++)
{
    $FNAME =pathinfo(strtolower(stream_get_line(STDIN, 500 + 1, "\n")), PATHINFO_EXTENSION);// One file name per line.
    (($FNAME != '')) ? $unknowTypes[$i] = $FNAME : $unknowTypes[$i] = "UNKNOWN" ;
}

foreach($unknowTypes as $type){
    if(array_key_exists($type,$refTypes)){
        echo($refTypes[$type]."\n");
        }else{
            echo("UNKNOWN\n");
        }
}