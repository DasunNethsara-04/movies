import React, { useEffect, useState } from 'react'
import axios from 'axios'
import MainNavbar from '../Components/MainNavbar'
import MovieCard from '../Components/MovieCard';
import { Col, Container, Row } from 'react-bootstrap';

const BoxOfficeList = () => {
    const [weekendTitleName, setWeekendTitleName] = useState('');
    const [movieList, setMovieList] = useState([]);
    useEffect(() => {
        axios.get('http://localhost:8000/api/get-box-office-list').then((response) => {
            console.log(response.data);
            // setMovieList(response.data);
            setWeekendTitleName(response.data.weekendTitle);
            setMovieList(response.data.topBoxOffice);
        });
    }, []);
    return (
        <>
            <MainNavbar />

            <Container fluid>
                <h1>Box Office</h1>
                <h3>{weekendTitleName}</h3>

                <Row>
                    {movieList.map((movie, index) => {
                        return (
                            <Col key={index} md={3} className="mb-4">
                                <MovieCard coverImg={movie.coverImage} title={movie.title}></MovieCard>
                            </Col>
                        );
                    })}
                </Row>
            </Container>


        </>
    )
}

export default BoxOfficeList