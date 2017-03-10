import React from 'react'
import { IndexLink, Link } from 'react-router'

const toggleSearch = (props) => {
    props.changeSearch();
}

export const Research = (props) => (
  <div className="searchBtn" onClick={toggleSearch.bind(this, props)}></div>
)

export default Research

