<?php

class FeedController extends Controller {
    public function GetBySlug($id) {
        $slug = $id;

        $feedSources = [
            new FeedSource("designtagebuch", "https://www.designtagebuch.de/feed/", "xml"),
            new FeedSource("neue-st", "https://neue.st/feed/", "xml")
        ];
        
        foreach ($feedSources as $fs) {
            if ($fs->slug == $slug) {
                $obj = $fs->getFeedResponse();
                return $obj;
            }
        }
    }
}