<?php
    include "db_connect.php";
    $mydb = new DB_connect();
    $sql = "SELECT lower(message) as 'message', timestamp FROM public_chats ORDER BY chat_id desc limit 20;";
    $result = $mydb->runQuery($sql);

    echo "<table class='table table-striped table-hover' >
            <thead><tr><th>messages</th></tr></thead><tbody>";
    while($row = mysqli_fetch_array($result)){
        $message = $row['message'];
        $time = $row['timestamp'];
        $phpdate = strtotime( $time );
        $time = date( 'M d, g:i', $phpdate );

        echo "<tr><td><p>".$message."</p><p style='text-align:right;'>".$time."</p></td></tr>";
    }
    echo "</tbody></table>";

    $sql = "SELECT count(*) as 'count' FROM public_chats;";
    $result2 = $mydb->runQuery($sql);

    $row = mysqli_fetch_array($result2);

    if($row['count'] > 20)
    {
        $pages = $row['count'] / 20;
        if(($row['count'] % 20) > 0)
        {
            $pages = $pages + 1;
        }

        echo "<nav>
                <ul class='pagination'>
                    <li class='disabled'><a><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>
                    <li class='active'><a href='#'>1<span class='sr-only'>(current)</span></a></li>";

        $num = 2;
        while($num < $pages)
        {
            echo "<li><a href='../archive.php?pg=".$num."'>".$num."</a></li>";
            $num = $num + 1;
        }
        echo "<li><a href='../archive.php?pg=2'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li></ul></nav>";
    }

?>