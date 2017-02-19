import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Header.scss'

import Logo from './Nav/Logo/Logo.js'
import ItemWrapper from './Nav/Item/ItemWrapper.js'
import Research from './Nav/Research/Research.js'
import Favorite from './Nav/Favorite/Favorite.js'
import Account from './Nav/Account/Account.js'


export const Header = () => (
  <div>
    <div className="header__left">
      <Logo/>
      <ItemWrapper/>
    </div>
    <div className="header__right">
      <Research/>
      <Favorite/>
      <Account/>
    </div>
  </div>
)

export default Header
