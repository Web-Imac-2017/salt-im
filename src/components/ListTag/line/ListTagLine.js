import React from 'react'
import './ListTagLine.scss'
import Tag from './Tag/Tag.js'
import R from 'ramda'


export const ListTagLine = (props) => {
    let tagsNode = props.data.map( (elmt,i) => (
        <Tag key={i} data={elmt}/>
    ))
    return (
      <div className="tags__line__div">
        <p>Retrouvez tous les tags</p>
        <div className="list__tags__line">
         {tagsNode}
       </div>
     </div>
    )
}


export default ListTagLine
