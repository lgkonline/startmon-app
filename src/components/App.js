import React, { useState, useEffect } from "react";

import { Feed } from "./Feed";

export const apiUrl = "http://localhost:4000/service";

function App() {
    const [feeds, setFeeds] = useState([]);

    const feedSlugs = [
        "designtagebuch",
        "neue-st",
        "t3n",
        "felixtense",
        "lgktube"
    ];

    useEffect(() => {
        if (feeds.length <= 0) {
            feedSlugs.forEach(slug => fetchFeed(slug));
        }
    });

    const fetchFeed = (slug) => {
        fetch(`${apiUrl}/Feed/GetBySlug/${slug}`)
            .then(res => {
                console.log(res);
                return res.json();
            })
            .then(feed => {
                console.log(feed);
                setFeeds(feeds => feeds.concat(feed));
            });
    }

    return (
        <div className="App">
            <h1 className="App-headline">Your feeds</h1>

            <div className="App-feeds">
                {feeds.map((feed, index) =>
                    <Feed key={index} {...feed} />
                )}
            </div>
        </div>
    );
}

export default App;
