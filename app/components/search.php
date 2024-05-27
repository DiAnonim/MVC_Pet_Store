<?php
function create_search_form($name, $action, $class = '', $placeholder = 'Поиск по названию') {
    echo "<form action='$action' method='post' class='$class'>
    <input type='text' name='$name' placeholder='$placeholder'>
    <button type='submit'>Поиск</button>
    </form>";
}