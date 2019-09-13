<?php

class Helpers {
    public static function GetAlternateLink(SimpleXMLElement $linkXMLElements) {
        foreach ($linkXMLElements as $link) {
            $attrs = $link->attributes()->rel;

            if ($link->attributes()->rel == "alternate") {
                return $link->attributes()->href->__toString();
            }
        }
    }
}