<?php
function display_heading($text, $level = 1) {
    echo "<h$level class='heading'>$text</h$level>";
}

function display_subheading($text, $link = '') {
    echo "<hr>";
    echo "<h3 class='subheading'><a style='color: rgb(126, 181, 230);' href='$link'>$text</a></h3>";
}
?>