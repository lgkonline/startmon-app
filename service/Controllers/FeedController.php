<?php

class FeedController extends Controller {
    public function GetBySlug($id) {
        $slug = $id;

        $feedSources = [
            new FeedSource("designtagebuch", "https://www.designtagebuch.de/feed/", "xml"),
            new FeedSource("neue-st", "https://neue.st/feed/", "xml"),
            new FeedSource("t3n", "https://t3n.de/rss.xml", "xml"),
            new FeedSource("felixtense", "https://www.youtube.com/feeds/videos.xml?channel_id=UCUfYwKXjabB60uw_mWdsALQ", "xml-atom")
        ];
        
        foreach ($feedSources as $fs) {
            if ($fs->slug == $slug) {
                $obj = $fs->getFeedResponse();
                return $obj;
            }
        }
    }
}