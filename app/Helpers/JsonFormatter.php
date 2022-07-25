<?php

function return_json($data = [], $code = 200, $msg = ""){
    $std = new stdClass;
    $std->data = $data;
    $std->meta = new stdClass;
    $std->meta->is_error = $code >= 200 && $code <= 200 ? false : true;
    $std->meta->code = $code;
    $std->meta->message = $msg;

    return response()->json($std, $code);
}