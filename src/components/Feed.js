import React from "react";

import { Post } from "./Post";

export function Feed({ title, latestPost }) {
    return (
        <div>
            <h1>{title}</h1>

            <Post {...latestPost} />
        </div>
    );
}