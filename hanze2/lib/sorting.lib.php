<?php
function parseSorting($action,$field_name,$field,$sort){
    $html = "";
    //ASC: &#9650;
    //DESC: &#9660;
    $ASC_class = "sorting_arrow";
    $DESC_class = "sorting_arrow";

    if($field_name==$field){
        if($sort=='ASC'){
            $ASC_class = "sorting_arrow sorting_used";
        }else{
            $DESC_class = "sorting_arrow sorting_used";
        }
    }

    $html = "<span class=\"$ASC_class\"><a href=\"index.php?action=$action&amp;sorting=ASC&amp;field=$field_name\">&#9650;</a></span>
             <span class=\"$DESC_class\"><a href=\"index.php?action=$action&amp;sorting=DESC&amp;field=$field_name\">&#9660;</a></span>";
    return $html;
}
?>
