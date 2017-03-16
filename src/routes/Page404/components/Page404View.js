import React, { Component } from 'react';
import { Link } from 'react-router';
import './Page404View.scss'


export default class Page404View extends Component {
  render() {
    return(
      <div className="error404">
        <div className="error404__background"/>
        <div className="error404__text">T'as pas trouvé la page t'es une Moby Dick</div>
      </div>
    )
  }
}
