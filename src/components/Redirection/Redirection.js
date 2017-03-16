import React, {Component} from 'react'
import {Link} from 'react-router'

import './Redirection.scss';

export default class Redirection extends Component {
  render() {
    return (
      <div className="center redirection">
        <div className="center redirection__text">Vous devez être connecté pour voir cette page.</div>
        <Link to="/auth"> <div className="center redirection__link">| Authentification | </div></Link>
      </div>
    )
  }

}
