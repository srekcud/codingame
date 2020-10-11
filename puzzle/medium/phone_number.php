<?php
fscanf(STDIN, "%d",
    $N //number of telephone numbers
);
$telephones = [];
$count = 0; //space for numbers
for ($i = 0; $i < $N; $i++)
{
    fscanf(STDIN, "%s",
        $telephone //telephone number
    );
    $length = strlen($telephone);
    for ($j = 1; $j <= $length; $j++)
    {
        $prefix = substr($telephone, 0, $j);
        if(!(isset($telephones[$prefix])))
        {
            $telephones[$prefix] = $prefix;
            $count++;
        }
    }
}
echo $count . "\n";
?>