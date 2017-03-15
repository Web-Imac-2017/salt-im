import React, {Component} from 'react'
import {Link} from 'react-router'

import './Redirection.scss';

export default class Redirection extends Component {
  render() {
    return (
      <div className="redirection">
        <div className="redirection__text">Vous devez être connecter pour voir cette page.</div>
        <Link to="/auth">Authentification</Link>
      </div>
    )
  }

}
