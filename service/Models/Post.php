<?php

class Post {
    public $title;
    public $link;
    public $_raw;

    public function __construct($_raw) {
        $this->_raw = $_raw;
        $this->encodeFromRaw();
    }

    public function encodeFromRaw() {
        if (isset($this->_raw->title)) {
            $this->title = $this->_raw->title->__toString();
        }

        if (isset($this->_raw->link)) {
            $this->link = $this->_raw->link->__toString();
        }
    }
}