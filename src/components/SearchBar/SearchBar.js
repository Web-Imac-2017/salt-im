import React from 'react'
import { IndexLink, Link } from 'react-router'
import './SearchBar.scss'

export const SearchBar = () => (
  <div className="searchbar">

    <h2 className="searchbar__text">Chercher un post, un tag, un profil</h2>

    <div className="searchbar__input">
      <div className="searchbar__input__iconsearch"></div>
      <input placeholder="Qui se rappelle de la harsh noise" type="text" className="searchbar__input__obj" />
    </div>
  </div>
)

export default SearchBar
