<?php

class OpenGraph {
    public $title;
    public $image;
    public $description;
    public $_raw;

    public function __construct($_raw) {
        $this->_raw = $_raw;
        $this->encodeFromRaw();
    }

    public function encodeFromRaw() {
        try {
            if (isset($this->_raw["og:title"])) {
                $this->title = $this->_raw["og:title"];
            }
    
            if (isset($this->_raw["og:image"])) {
                $this->image = $this->_raw["og:image"];
            }
        }
        catch(\Exception $ex) {

        }
    }
}