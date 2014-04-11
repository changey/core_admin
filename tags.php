<?php
require_once 'rnheader.php';
?>
<html>
<head>
    <title></title>
</head>

<body>
<?php
if ($loggedin) {
    echo("<form method='post' action='tag_insert.php?&user=" . $user . "'>$error"); ?>
<?php
echo <<<_END
<p>Add a new tag</p>
Tag Name <input type='text' maxlength='16' name='name'
value='$name' /><br /><br />
<input type='submit' value='Add' />
_END;
?>
<div class="inner">
    <?php
    include_once 'sqlfoo.php';
    include_once 'config.php';

    // sending query
    echo "
		<table>
			<tr>
				";?>
    <th>Tag</th>
    <th></th>
    </tr>
    <!--<th width=20%>Time Left</th>";-->
    <?php

    $query = "SELECT * FROM tags ORDER BY name";
    // if (mysql_num_rows(mysql_query($query)) == 0) {
    // //$error = "That username already exists<br /><br />";
    // echo 0;
    // } else {
    $result = mysql_query($query) or die(mysql_error($con));
    if (!$result) {
        die("Query to show fields from table failed");
    }
    $stack = array();

    while ($row = mysql_fetch_row($result)) {
        echo "<tr>
                            <td>";
        echo $row[1];

        echo "</td>";
        echo "<td>";
        echo("<button type=\"button\" id=\"delete-$row[0]\">Delete</button>");
        echo"</td>";     
        echo "</tr>";
        //$user_id = $row[2];
        //$data = array("id" => $row[0], "sender" => $row[1], "receiver" => $row[2], "url" => $row[3], "time" => $row[4], "captions" => $row[5]);
        $data = array("name" => urlencode($row[1]));

        array_push($stack, $data);
        //echo $user_id;

        //$query = "INSERT INTO friends (user, friend_id) VALUES('$user', $friend_id)";
        mysql_query($query);
    }
    ?>
    </table>
</div>
<?php
}
?>
<!--<img src="displayImg.php?url=http://www.geonames.org/flags/x/tw.gif" />-->
</body>
<style>

    body {

        background-attachment: fixed;

        background-image: url(images/bg2.jpg);

        background-repeat: repeat;

        background-position: right bottom;

    }

    table {
        overflow: hidden;
        border: 1px solid #d3d3d3;
        background: #fefefe;
        width: 90%;
        margin: 5% auto 0;
        -moz-border-radius: 5px; /* FF1+ */
        -webkit-border-radius: 5px; /* Saf3-4 */
        border-radius: 5px;
        -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
    }

    th, td {
        text-align: center;
    }

    th {
        padding-top: 22px;
        text-shadow: 1px 1px 1px #fff;
        background: #e8eaeb;
    }

    td {
        border-top: 1px solid #e0e0e0;
        border-right: 1px solid #e0e0e0;
    }

    tr.odd-row td {
        background: #f6f6f6;
    }

    td.first, th.first {
        text-align: left
    }

    td.last {
        border-right: none;
    }

    /*
    Background gradients are completely unnecessary but a neat effect.
    */
    td {
        background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
        background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
    }

    tr.odd-row td {
        background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
        background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
    }

    th {
        background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
        background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
    }

    /*
    I know this is annoying, but we need additional styling so webkit will recognize rounded corners on background elements.  Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
    And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
    */
    tr:first-child th.first {
        -moz-border-radius-topleft: 5px;
        -webkit-border-top-left-radius: 5px; /* Saf3-4 */
    }

    tr:first-child th.last {
        -moz-border-radius-topright: 5px;
        -webkit-border-top-right-radius: 5px; /* Saf3-4 */
    }

    tr:last-child td.first {
        -moz-border-radius-bottomleft: 5px;
        -webkit-border-bottom-left-radius: 5px; /* Saf3-4 */
    }

    tr:last-child td.last {
        -moz-border-radius-bottomright: 5px;
        -webkit-border-bottom-right-radius: 5px; /* Saf3-4 */
    }
</style>
</html>