import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { differenceInYears } from 'date-fns';

import './home.styles.scss';
import me from '../../assets/me.jpg';
import { ReactComponent as Quote } from '../../assets/quote.svg';

class HomePage extends Component {
    constructor() {
        super();

        this.state = {
            quotes: [
                {
                    quote: 'The size of your dreams must always exceed your current capacity to achieve them. If your dreams don’t scare you, they aren’t big enough.',
                    author: 'Ellen Johnson Sirleaf'
                }
            ]
        };
    }

    render() {
        const { quotes } = this.state;
        const randomQuoteIndex = Math.floor(Math.random() * quotes.length);

        return (
            <div className='home-page'>
                <div className='greeting-container'>
                    <h1 className='title'>Hello there, <span className='highlight'>stranger!</span></h1>
                    <p className='paragraph'>
                        <span>
                            Seems like you've reached my website, so let me introduce myself.<br />
                            My name is <span className='highlight'>Lucas Padilha</span>, 
                            I'm a { differenceInYears(new Date(), new Date(1995, 7, 7)) } years old Web Developer from Brazil, currently living in Italy. <br />
                            For the past { differenceInYears(new Date(), new Date(2015, 1, 1)) } years I've worked mainly 
                            with <span className='highlight'>PHP</span>, <span className='highlight'>Javascript</span>,
                            <span className='highlight'> CSS</span>, <span className='highlight'>SQL</span>, <span className='highlight'>Docker</span> & <Link to='/about' className='link'>more</Link>.<br />
                            If you wanna learn more about what I've done and what I can do, <Link to='/about' className='link'>click here</Link>.
                        </span>
                    </p>
                    <h1>Nice to meet you.</h1>
                </div>

                <img src={ me } alt='myself' className='myself' />

                <div className='quote-container'>
                    <h2 className='quote'>
                        <Quote className='icon' />
                        <span>{ quotes[randomQuoteIndex].quote }</span>
                    </h2>
                    <span className='author'>{ quotes[randomQuoteIndex].author }</span>
                </div>
            </div>
        );
    }
}

export default HomePage;