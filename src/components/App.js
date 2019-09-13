import React, { useState, useEffect } from "react";

import { Feed } from "./Feed";

export const apiUrl = "http://localhost:4000/service";

function App() {
    const [feeds, setFeeds] = useState([]);

    const feedSlugs = [
        "designtagebuch",
        "neue-st"
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
            {feeds.map((feed, index) =>
                <Feed key={index} {...feed} />
            )}
        </div>
    );
}

export default App;
