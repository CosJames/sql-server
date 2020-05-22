<?php

    function STATUS_OK($message)
    {
        return json_encode(array(
            'code' => '200',
            'message' => $message
        ));
    }

    function STATUS_CONFLICT($message)
    {
        return json_encode(array(
            'code' => '409',
            'message' => $message
        ));
    }


    function STATUS_BAD_REQUEST($message)
    {
        return json_encode(array(
            'code' => '400',
            'message' => $message
        ));
    }

    function STATUS_NOT_FOUND($message)
    {
        return json_encode(array(
            'code' => '404',
            'message' => $message
        ));
    }

