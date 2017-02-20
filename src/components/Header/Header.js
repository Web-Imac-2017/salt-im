import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Header.scss'

import Research from './Nav/Research/Research.js'
import Account from './Nav/Account/Account.js'

export const Header = () => (
  
  <div className="header">
    
    <div className="header__left">
      
      <div className="logo">
        <div className="logo__img"></div>
        <p className="logo__title">Salt-Im</p>
      </div>

      <div className="itemnav">
        <ul className="itemnav__list">
            <li className="itemnav__list__item">Tags</li>
            <li className="itemnav__list__item">Posts</li>
            <li className="itemnav__list__item">Vicos</li>
        </ul>
      </div>
    </div>
    
    <div className="header__right">

      <div className="addPostBtn">Ajouter un post</div>
      
      <Research/>
      
      <div className="saveBtn"></div>
      
      <Account/>
    </div>
  </div>
)

export default Header
