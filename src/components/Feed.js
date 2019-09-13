import React from "react";

import { Post } from "./Post";

export function Feed({ title, link, latestPost }) {
    return (
        <div className="Feed">
            <Post {...latestPost} />
            <h5 className="Feed-title">
                <a href={link} className="Feed-link" target="_blank" rel="noopener noreferrer">{title}</a>
            </h5>
        </div>
    );
}