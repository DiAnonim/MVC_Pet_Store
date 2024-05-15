<?php

class Controller_Privacy extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function action_index()
    {
        echo "<a href='/mvc/privacy/cookies'>About Cookies</a>";
    }

    function action_cookies()
    {
        echo "<h2>About Cookies</h2>";
    }

}
?>