<?php
namespace App\Enums;

enum SupportStatus:string{
    case PENDING = 'Pending';
    case OPEN = 'Open';
    case CLOSED = 'Closed';

    public static function fromValue(string $name):string{
        foreach(self::cases() as $status){
            if($name === $status->name){
                return $status->value;
            }
        }
        throw new \ValueError("$status is not a valid");
    }
}
