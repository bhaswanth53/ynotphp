<?php
    use Facades\Crypt;

    $enc = Crypt::encrypt("This is the plain text");
    echo $enc;
    echo "<br><br>";
    echo Crypt::decrypt($enc);

    echo $id;
    echo $kd;
    echo $nt;

?>