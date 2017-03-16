import React, { Component } from 'react';
import { IndexLink, Link } from 'react-router'
import './Header.scss'

import Research from './Nav/Research/Research.js'
import Account from './Nav/Account/Account.js'
import BigSearch from './BigSearch/BigSearch.js';

export default class Header extends Component {
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
    let addPostContent = (
      <div>
        <Link to="/post/create"><div className="addPostBtn">Ajouter un post</div></Link>
        <Link to="/post/create"><div className="addPostBtn--mobile"><div className="addPostBtn__text">+</div></div></Link>
      </div>
    )

    if(!this.props.dataUser)
      addPostContent=(<div/>)
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
                <li className="itemnav__list__item">Vicos</li>
            </ul>
          </div>
        </div>

        <div className="header__right">
          {addPostContent}
          <Research changeSearch={this.handleChangeBigSearch.bind(this)}/>

          <Account dataUser={this.props.dataUser}/>
        </div>

        <BigSearch isOpen={this.state.isOpen} handleClose={this.handleChangeBigSearch.bind(this)} />
      </div>
    );
  }
}
