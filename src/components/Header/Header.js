import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Header.scss'

import Research from './Nav/Research/Research.js'
import Account from './Nav/Account/Account.js'
import BigSearch from './BigSearch/BigSearch.js';

const changeSearch = (props) => {
  console.log(props)
}

export const Header = () => (

  <div className="header">
    <div className="header__left">

      <Link className="logo" to="/">
        <div className="logo__img"></div>
        <p className="logo__title">Salt-Im</p>
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

      <Research changeSearch={changeSearch}/>

      <div className="saveBtn"></div>

      <Account/>
    </div>
    <BigSearch/>
  </div>
)

export default Header
