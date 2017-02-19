import React from 'react'
import { IndexLink, Link } from 'react-router'
import Item from './Item.js'
import './Item.scss'

export const ItemWrapper = () => (
  <div>
    <ul>
        <Item title="Tags" goTo="/tags"/>
        <Item title="Post" goTo="/post"/>
        <Item title="Vicos" goTo="/vicos"/>
    </ul>
  </div>
)

export default ItemWrapper

