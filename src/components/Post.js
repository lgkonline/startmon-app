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
            {(openGraph && openGraph.image) &&
                <img
                    src={openGraph.image}
                    alt={openGraph.title}
                    style={{
                        width: "300px"
                    }}
                />
            }
            <h4><a href={link} target="_blank" rel="noopener noreferrer">{title}</a></h4>
        </div>
    );
}