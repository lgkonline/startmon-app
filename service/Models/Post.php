<?php

class Post {
    public $title;
    public $link;
    public $_raw;

    public function __construct($_raw, FeedSource $feedSource) {
        $this->_raw = $_raw;
        $this->encodeFromRaw($feedSource);
    }

    public function encodeFromRaw(FeedSource $feedSource) {
        if ($feedSource->format == "xml" || $feedSource->format == "xml-atom") {
            if (isset($this->_raw->title)) {
                $this->title = $this->_raw->title->__toString();
            }
        }

        if ($feedSource->format == "xml-atom") {
            $this->link = Helpers::GetAlternateLink($this->_raw->link);
        }

        if ($feedSource->format == "xml") {
            if (isset($this->_raw->link)) {
                $this->link = $this->_raw->link->__toString();
            }
        }
    }
}