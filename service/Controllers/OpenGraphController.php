<?php

class OpenGraphController extends Controller {
    public function GetOpenGraph($url) {
        try {
            $html = file_get_contents($url);
    
            libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
            $doc = new DomDocument();
            $doc->loadHTML($html);
            $xpath = new DOMXPath($doc);
            $query = '//*/meta[starts-with(@property, \'og:\')]';
            $metas = $xpath->query($query);
            $rmetas = array();
            foreach ($metas as $meta) {
                $property = $meta->getAttribute('property');
                $content = $meta->getAttribute('content');
                $rmetas[$property] = $content;
            }
            
            return new OpenGraph($rmetas);
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }
}