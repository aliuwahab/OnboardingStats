<?php
require "src/Router.php";



// Helper to load views
function view($view, array $data = [])
{
    // Extract the keys of the data posted into variables
    extract($data);

    return require "views/$view.view.php";
}