<?php

class FeedResponse {
    public $title;
    public $link;
    public $latestPost;
    public $_raw;

    public function __construct($_raw, FeedSource $feedSource) {
        $this->_raw = $_raw;
        $this->encodeFromRaw($feedSource);
    }

    public function encodeFromRaw(FeedSource $feedSource) {

        try {
            if ($feedSource->format == "xml-atom") {
                if (isset($this->_raw->title)) {
                    $this->title = $this->_raw->title->__toString();
                }

                $this->link = Helpers::GetAlternateLink($this->_raw->link);

                if (isset($this->_raw->entry) && count($this->_raw->entry) > 0) {
                    $this->latestPost = new Post($this->_raw->entry[0], $feedSource);
                }
            }

            if ($feedSource->format == "xml") {
                if (isset($this->_raw->channel->title)) {
                    $this->title = $this->_raw->channel->title->__toString();
                }
                if (isset($this->_raw->channel->link)) {
                    $this->link = $this->_raw->channel->link->__toString();
                }
                if (isset($this->_raw->channel->item) && count($this->_raw->channel->item) > 0) {
                    $this->latestPost = new Post($this->_raw->channel->item[0], $feedSource);
                }
            }
        }
        catch(\Exception $ex) {}
    }
}