import React from 'react';
import { withRouter } from 'react-router-dom';
import './not-found.styles.scss';

const NotFoundPage = ({ history }) => {
    return (
        <div>
            404!
        </div>
    );
};

export default withRouter(NotFoundPage);