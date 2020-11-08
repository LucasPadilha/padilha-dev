import React from 'react';
import { Link } from 'react-router-dom';

import { ReactComponent as Logo } from '../../assets/logo-v2.svg';
import './header.styles.scss';

const Header = (props) => {
    return (
        <div className='header'>
            <div className='logo-container'>
                <Link to='/'>
                    <Logo className='logo' />
                </Link>
            </div>

            <div className='nav-container desktop'>
                <div className='item'>
                    <Link to='/' className='link'>Home</Link>
                </div>
                <div className='item'>
                    <Link to='/about' className='link'>About</Link>
                </div>
                <div className='item'>
                    <Link to='/contact' className='link'>Contact</Link>
                </div>

                <div className='social'>
                    <div className='item'>
                        <a href='https://github.com/LucasPadilha' target="_blank" rel="noopener noreferrer">
                            <i className="fab fa-github"></i>
                        </a>
                    </div>
                    <div className='item'>
                        <a href='https://instagram.com/padilha.dev' target="_blank" rel="noopener noreferrer">
                            <i className="fab fa-instagram"></i>
                        </a>
                    </div>
                    <div className='item'>
                        <a href='mailto:hey@lplabs.com.br' target="_blank" rel="noopener noreferrer">
                            <i className="far fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Header;