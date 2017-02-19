import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Logo.scss'


export const Logo = () => (
  <Link to="/">
       <img src="WHALE.png" alt="logoPic" height="42" width="42"/>
       <p>Salt-Im</p>
  </Link>
)

export default Logo

