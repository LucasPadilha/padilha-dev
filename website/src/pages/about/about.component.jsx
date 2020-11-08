import React from 'react';
import { differenceInYears } from 'date-fns';

import './about.styles.scss';

const AboutPage = (props) => {
    return (
        <div className='about-page'>
            <div className='content-container'>
                <h1 className='title'>About me</h1>
                <p>
                    Hi there. My name is <span className='highlight'>Lucas Padilha</span>, I'm { differenceInYears(new Date(), new Date(1995, 7, 7)) } years old, 
                    born in São Paulo - Brazil, currently <span className='highlight'>living in Italy (Veneto region)</span>. <br /><br />

                    I taught myself how to code in my early 14's. My first few lines of code turned out to be a Top 10 on a Tibia private server I was building 
                    just for fun on my machine and, since then, I've been in love with technology and software development.<br /><br />

                    I have an <span className='highlight'>Associate Degree in Internet Systems</span> by UNIVALI (Universidade do Vale do Itajaí) and 
                    <span className='highlight'> over { differenceInYears(new Date(), new Date(2015, 1, 1)) } years of professional experience</span> in Web Development.<br /><br />

                    Over the years I've been working in different areas of development to build expertise around all processes. I've worked as <span className='highlight'>Back-end</span>, 
                    <span className='highlight'> Front-end</span> and lately as <span className='highlight'>Team Leader</span> and <span className='highlight'>Project Manager</span>.<br /><br />
                </p>

                <h2 className='subtitle'>Past experiences</h2>

                <p>
                    My professional career started in early 2015, where I have been hired as <span className='highlight'>Back-End Developer</span> to maintain a legacy ERP
                    for accounting professionals while developing the new version of the same ERP. This is where I started to learn about <span className='highlight'>Object Oriented Programming</span>, 
                    <span className='highlight'> SQL</span>, <span className='highlight'>REST API's</span> and <span className='highlight'>Linux</span>.<br /><br />

                    In mid-2016 I felt the need to learn more in depth <span className='highlight'>Javascript</span> and <span className='highlight'>CSS</span> and by that time I had the opportunity to work at
                    an Agency and took the leap. Now I was working as <span className='highlight'>Front-End Developer</span>, building Websites and Web Apps faster than I have ever before. At this agency I've
                    learnt about <span className='highlight'>Javascript</span> (and libraries like jQuery), <span className='highlight'>CSS</span> (and frameworks like Bootstrap & Bulma), <span className='highlight'>SEO</span>, 
                    <span className='highlight'> Responsive Design</span>, <span className='highlight'>MacOS</span> and tools like <span className='highlight'>Adobe Photoshop</span>.<br /><br />

                    By the middle of 2017 I received an offer to work as <span className='highlight'>Team Leader</span> in a StartUp in the medical field. To accept this job I had to move to another city,
                    where I didn't know anyone (I didn't even knew the city itself). It was quite a challenge: Lead a team of 3 developers to build, from scratch, a <span className='highlight'>Website</span>, 
                    <span className='highlight'> Android</span> & <span className='highlight'> iOS App</span>, <span className='highlight'>REST API</span> and a lot of integrations with third-party services. 
                    All of that was really exciting and in a couple of months I learnt a lot about <span className='highlight'>team management</span>, <span className='highlight'>task priority</span>, 
                    <span className='highlight'> system modeling</span>, <span className='highlight'>database modeling</span> and <span className='highlight'>version control</span>.<br /><br />

                    In early 2018 I received an offer to work as <span className='highlight'>Project Manager</span> on a company I always wanted to work on.
                    My expectations were high and have been exceeded. Now I was leading a team of 5 people (3 developers, 1 tester and 1 client support) and our job was to 
                    maintain <span className='highlight'>the biggest system I ever worked with</span>, which had also an Android App and an API. I was in charge of this main project, but also 3 smaller projects.
                    There I learnt tons of technical and soft skills, such as <span className='highlight'>Docker</span>, <span className='highlight'>Continuous Delivery</span>,
                    <span className='highlight'> how to deal with clients</span>, <span className='highlight'>in-depth SQL</span>, <span className='highlight'>NO-SQL</span>, 
                    <span className='highlight'> Node.js</span>, <span className='highlight'>BASH</span>, <span className='highlight'>Server management</span> and <span className='highlight'>GIS</span> (Geographic Information System Mapping).
                    I also improved my <span className='highlight'>Team management</span>, <span className='highlight'>Team leadership</span> and <span className='highlight'>Task management</span> skills.<br /><br />
                </p>

                <h2 className='subtitle'>Other experiences</h2>

                <p>
                    I'm also in love with the StartUp culture and took the <span className='highlight'>3rd position</span> in the 1st StartUp Weekend that took place in Balneário Camboriú, where me and 
                    a team composed by 2 administrators, 1 designer and another developer came up with an idea to develop a plataform where people with food restrictions could find places and recipes to eat.<br />
                    <span className='highlight'>We pivoted</span> more than once, <span className='highlight'>built an website</span> to validate the idea where people could pre sign-up and <span className='highlight'>pitched</span> 
                    our platform to more than 100 people. All of that <span className='highlight'>in less than 48 hours</span>. I was quite a challenge, 
                    but the efforts paid off when <span className='highlight'>we were selected by the judges</span>.
                </p>
            </div>
        </div>
    );
};

export default AboutPage;