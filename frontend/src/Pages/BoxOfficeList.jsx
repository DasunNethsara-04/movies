import React, { useEffect, useState } from 'react'
import axios from 'axios'
import MainNavbar from '../Components/MainNavbar'

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
            <h1>Box Office</h1>
            <h3>{weekendTitleName}</h3>
            <ul>
                {movieList.map((movie, index) => {
                    return (
                        <li key={index}>{movie.title.slice(3)}
                            <div>
                                <img src={movie.coverImage} alt={movie.title} />
                                <p>Rating: {movie.rating}</p>
                            </div>
                        </li>
                    );
                })}
            </ul>
        </>
    )
}

export default BoxOfficeList