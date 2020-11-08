import React, { Component } from 'react';
import FormInput from '../../components/form-input/form-input.component';
import CustomButton from '../../components/custom-button/custom-button.component';

import './contact.styles.scss';

class ContactPage extends Component {

    constructor() {
        super();

        this.state = {
            name: '',
            email: '',
            message: ''
        };
    }

    handleSubmit = (event) => {
        event.preventDefault();

        const { name, email, message } = this.state;

        const body = {
            name: name,
            email: email,
            message: message
        };

        fetch('http://localhost:8000/contact', {
            method: 'post',
            headers: {
                'Content-type': 'application/json; charset:UTF-8'
            },
            body: JSON.stringify(body)
        })
        .then((res) => res.json())
        .then(({ error, message }) => {
            alert(message);

            if (!error) {
                this.setState({ name: '', email: '', message: '' });
            }
        })
        .catch((error) => {
            console.log(error);
        });
    }

    handleChange = (event) => {
        const { value, name } = event.target;

        this.setState({ [name]: value });
    }

    render() {
        return (
            <div className='contact-page'>
                <div className='content-container'>
                    <h1 className='title'>Get in touch</h1>
                    <p className='subtitle'>
                        For any queries, concerns or feedback, get in touch with me by either filling out the form below or by sending me an e-mail at lucas[at]padilha.dev.
                    </p>
    
                    <form onSubmit={ this.handleSubmit }>
                        <FormInput handleChange={ this.handleChange } value={ this.state.name } label='Name' name='name' type='text' required />
                        <FormInput handleChange={ this.handleChange } value={ this.state.email } label='E-mail' name='email' type='email' required />
                        <FormInput handleChange={ this.handleChange } value={ this.state.message } label='Message' name='message' type='text' required />

                        <div className='form-footer'>
                            <CustomButton>Submit</CustomButton>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
};

export default ContactPage;