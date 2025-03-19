<?php 
    function date_format($date) {
        $timestamp = strtotime($date);
        return date("H:i d/m/Y", $timestamp);
    }
?>