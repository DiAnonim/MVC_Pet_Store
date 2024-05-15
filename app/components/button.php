<?php
function create_button($text, $link, $class = '') {
    echo "<a href='$link' class='btn $class'>$text</a>";
}
?>