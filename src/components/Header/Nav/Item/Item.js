import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Item.scss'

export const Item = (props) => (
  <li>
    <Link to={props.goTo}>
        {props.title}
    </Link>
  </li>
)

export default Item

