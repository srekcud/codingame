<?fscanf(STDIN, "%d %d %d %d %d %d %d %d",$a,$b,$c,$d,$e,$f,$g,$h);$m=[];for($i=0;$i<$h;$i++){fscanf(STDIN, "%d %d",$n,$o);$m[$n] = $o;}while(1){fscanf(STDIN, "%d %d %s",$p,$q,$r);if($r=="LEFT"){if(($q==0)||($p!=$d&&$q<$m[$p])||($p == $d && $q < $e )){echo("BLOCK\n");}else{echo("WAIT\n");}}else{if(($q==$b-1)||($p!=$d&&$q>$m[$p])||($p==$d&&$q>$e)){echo("BLOCK\n");}else{echo("WAIT\n");}}}