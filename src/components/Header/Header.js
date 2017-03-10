import React, { Component } from 'react';
import { IndexLink, Link } from 'react-router'
import './Header.scss'

import Research from './Nav/Research/Research.js'
import Account from './Nav/Account/Account.js'
import BigSearch from './BigSearch/BigSearch.js';

class Header extends Component {
  constructor(props) {
    super(props);

    this.state = {
        isOpen:false
    };
  }

  handleChangeBigSearch() {
    if(this.state.isOpen)
      this.setState({isOpen:false})
    else
      this.setState({isOpen:true})
  }

  render() {
    return (
      <div className="header">
        <div className="header__left">

          <Link className="logo" to="/">
            <div className="logo__img"></div>
            <p className="logo__title">The Salt Factory</p>
          </Link>

          <div className="itemnav">
            <ul className="itemnav__list">
                <Link to="/tags"><li className="itemnav__list__item">Tags</li></Link>
                <li className="itemnav__list__item">Posts</li>
                <li className="itemnav__list__item">Vicos</li>
            </ul>
          </div>
        </div>

        <div className="header__right">

          <Link to="/create/post"><div className="addPostBtn">Ajouter un post</div></Link>
          <Link to="/create/post"><div className="addPostBtn--mobile"><div className="addPostBtn__text">+</div></div></Link>

          <Research changeSearch={this.handleChangeBigSearch.bind(this)}/>

          <div className="saveBtn"></div>

          <Account/>
        </div>
        <BigSearch isOpen={this.state.isOpen} />
      </div>
    );
  }
}

export default Header;
