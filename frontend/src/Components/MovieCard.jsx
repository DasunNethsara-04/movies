import React, { useState } from 'react';
import { Card } from 'react-bootstrap';

const MovieCard = ({ coverImg, title, description }) => {
    const [hovered, setHovered] = useState(false);

    return (
        <Card
            className="movie-card"
            onMouseEnter={() => setHovered(true)}
            onMouseLeave={() => setHovered(false)}
            style={{
                width: '200px',
                height: '300px',
                position: 'relative',
                overflow: 'hidden', // Ensure no overflow of image
                borderRadius: '10px', // Optional: Add rounded corners to the card
            }}
        >
            {/* Card image as background */}
            <div
                className="movie-card-img"
                style={{
                    backgroundImage: `url('${coverImg}')`, // Make sure the URL is in quotes
                    backgroundSize: 'cover', // Ensures image fills the card while maintaining its aspect ratio
                    backgroundPosition: 'center', // Center the image in the card
                    width: '100%',
                    height: '100%',
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    zIndex: -1, // Place the image behind the card content
                }}
            />
            <Card.Body
                className="text-center"
                style={{
                    position: 'absolute',
                    top: 0,
                    bottom: 0,
                    left: 0,
                    right: 0,
                    display: 'flex',
                    flexDirection: 'column',
                    justifyContent: 'center',
                    alignItems: 'center',
                    padding: '10px',
                    zIndex: 1, // Ensure text stays on top of the image
                }}
            >
                <Card.Title className="movie-card-title">{title}</Card.Title>
                <div className={`card-overlay ${hovered ? 'show' : ''}`}>
                    <Card.Text>{description}</Card.Text>
                </div>
            </Card.Body>
        </Card>
    );
};

export default MovieCard;
