<?php

namespace Utility;

class Utility
{
    static function findObjectById($id, array $array)
    {

        foreach ($array as $element) {
            if ($id == $element->getId()) {
                return $element;
            }
        }

        return null;
    }
}