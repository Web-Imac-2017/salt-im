import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Research.scss'

export const Research = () => (
  <div>
    <IndexLink to='/' activeClassName='route--active'>
      Home
    </IndexLink>
    {' · '}
    <Link to='/counter' activeClassName='route--active'>
      Counter
    </Link>
  </div>
)

export default Research
