<?php
//Count number of visits, and save result to cookie
    if (!isset($_COOKIE['visits'])) {
        setcookie('visits', 1, time() + 3600 * 24 * 365);
    } else {
        $counter = $_COOKIE['visits'];
        $counter++;
        setcookie('visits', $counter, time() + 3600 * 24 * 365);
    }

//function to show number of visit(couldn't do it in one function because cookie has to be set before anything is send to the browser)

function showVisits(){
    if(!isset($_COOKIE['visits'])) {
        echo 'Welcome, it is your first time on our website';
    }else{
        echo 'Welcome, you have already visited our site ' . $_COOKIE['visits'] . ' times &nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>';
    }
}