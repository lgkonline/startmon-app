<?php

class FeedResponse {
    public $title;
    public $latestPost;
    public $_raw;

    public function __construct($_raw) {
        $this->_raw = $_raw;
        $this->encodeFromRaw();
    }

    public function encodeFromRaw() {
        if (isset($this->_raw->channel->title)) {
            $this->title = $this->_raw->channel->title->__toString();
        }

        try {
            if (isset($this->_raw->channel->item) && count($this->_raw->channel->item) > 0) {
                $this->latestPost = new Post($this->_raw->channel->item[0]);
            }
        }
        catch(\Exception $ex) {

        }
    }
}