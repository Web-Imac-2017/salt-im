import React from 'react'
import './ListTagColumn.scss'
import Tag from './Tag/Tag.js'
import CreateTag from './CreateTag/CreateTag.js'
import R from 'ramda'


export const ListTagColumn = (props) => {
    let tagsNode = props.data.map( (elmt,i) => (
        <Tag key={i} data={elmt}/>
    ))
    return (
      <div className="tags__column__div">
        <p>Tags Tendances</p>
        <CreateTag/>
        <div className="list__tags__column">
         {tagsNode}
       </div>
     </div>
    )
}

export default ListTagColumn
