import React, { useState, useEffect } from "react";

import { apiUrl } from "./App";

export function Post({ title, link }) {
    const [openGraph, setOpenGraph] = useState(null);

    useEffect(() => {
        if (!openGraph) {
            fetchOpenGraph();
        }
    });

    const fetchOpenGraph = () => {
        fetch(`${apiUrl}/OpenGraph/GetOpenGraph/?url=${link}`)
            .then(res => res.json())
            .then(og => { console.log(og); setOpenGraph(og); });
    }

    return (
        <div>
            <a href={link} className="Post" target="_blank" rel="noopener noreferrer">
                <div
                    className="Post-image"
                    style={{ backgroundImage: (openGraph && openGraph.image) ? `url(${openGraph.image})` : "" }}
                />
                <h4>{title}</h4>
            </a>
        </div>
    );
}