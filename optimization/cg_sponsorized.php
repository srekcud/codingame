<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $firstInitInput
);
fscanf(STDIN, "%d",
    $secondInitInput
);
fscanf(STDIN, "%d",
    $thirdInitInput
);
error_log(var_export($firstInitInput, true));
error_log(var_export($secondInitInput, true));
error_log(var_export($thirdInitInput, true));

// game loop
while (TRUE)
{
    fscanf(STDIN, "%s",
        $firstInput
    );
    fscanf(STDIN, "%s",
        $secondInput
    );
    fscanf(STDIN, "%s",
        $thirdInput
    );
    fscanf(STDIN, "%s",
        $fourthInput
    );
    for ($i = 0; $i < $thirdInitInput; $i++)
    {
        fscanf(STDIN, "%d %d",
            $fifthInput,
            $sixthInput
        );
        error_log(var_export($fifthInput, true));
error_log(var_export($sixthInput, true));
    }

error_log(var_export($firstInput, true));
error_log(var_export($secondInput, true));
error_log(var_export($thirdInput, true));
error_log(var_export($fourthInput, true));
    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));

    //echo("A, B, C, D or E\n");
    echo("A\n");
}
?>