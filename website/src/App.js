import React from 'react';
import { Switch, Route } from 'react-router-dom';

import HomePage from './pages/home/home.component';
import AboutPage from './pages/about/about.component';
import ContactPage from './pages/contact/contact.component';
import NotFoundPage from './pages/not-found/not-found.component';
import Header from './components/header/header.component';

import './App.scss';

function App() {
  return (
    <div className='app'>
      <Header />
      <Switch>
        <Route exact path='/' component={ HomePage } />
        <Route exact path='/about' component={ AboutPage } />
        <Route exact path='/contact' component={ ContactPage } />
        <Route component={ NotFoundPage } />
      </Switch>
    </div>
  );
}

export default App;
