<?php

class FeedSource {
    public $slug;
    public $url;
    public $format;

    public function __construct($slug, $url, $format) {
        $this->slug = $slug;
        $this->url = $url;
        $this->format = $format;
    }

    public function getObject() {
        $content = file_get_contents($this->url);

        if (strpos("xml", $this->format) !== false) {
            // Is XML
            return simplexml_load_string($content);
        }
    }

    public function getFeedResponse() {
        $raw = $this->getObject();
        return new FeedResponse($raw, $this);
    }
}