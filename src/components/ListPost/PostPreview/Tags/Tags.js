import React from 'react'
import './Tags.scss'
import Tag from "./Tag/Tag.js"

export const Tags = (props) => {
    let tagsNode = props.data.map( (elmt,i) => (
        <Tag key={i} data={elmt}/>
    ))

    return (
      <div className="preview__tags">
        {tagsNode}
      </div>
    )
}

export default Tags
