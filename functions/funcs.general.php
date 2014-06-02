<?php

function sanitise($str)
{
	return strtolower(strip_tags(trim(($str))));
}

function time_elapsed_string($datetime, $full = false) 
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function in_multiarray($elem, $array)
{
    $top = sizeof($array) - 1;
    $bottom = 0;
    while($bottom <= $top)
    {
        if($array[$bottom] == $elem)
            return true;
        else 
            if(is_array($array[$bottom]))
                if(in_multiarray($elem, ($array[$bottom])))
                    return true;
                
        $bottom++;
    }        
    return false;
}

function getAllTags() 
{
    $tags = Array();
    $sql = "SELECT tag, COUNT(*) freq
            FROM tags
            GROUP BY tag
            ORDER BY freq DESC
            LIMIT 20";
    $result = mysql_query($sql) or die("Error getting tags: ".mysql_error());
    while ($row = mysql_fetch_assoc($result)) 
    {
        $tags[] = $row['tag'];
    }
    return $tags;
}

?>