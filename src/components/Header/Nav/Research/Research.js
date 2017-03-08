import React from 'react'
import { IndexLink, Link } from 'react-router'

const toggleSearch = (props) => {
    props.changeSearch();
}

export const Research = (props) => (
  <div onClick={toggleSearch.bind(this, props)}>
    <div className="searchBtn"></div>
  </div>
)

export default Research

