<?php

namespace App;

trait UserTypeTrait
{
    public  function statusR($status)
    {
        switch ($status) {
            case 1:
                $status = 'user';
                break;
            case 2:
                $status = 'developer';
                break;
            case 3:
                $status = 'owner';
                break;
            case 4:
                $status = 'teacher';
                break;
        }
        return $status;
    }
}
