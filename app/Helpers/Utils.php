<?php

function vdd(...$data) 
{
    foreach ($data as $row) {
        echo json_encode($row);
    }
    die();
}