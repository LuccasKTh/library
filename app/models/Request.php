<?php

class Request
{
    public static function order($fillable, $request)
    {
        $order = [];
        foreach ($fillable as $field) {
            if (isset($request[$field])) {
                $order[$field] = $request[$field];
            } else {
                throw new Exception("Field not found.");
            }
        }

        return $order;
    }
}