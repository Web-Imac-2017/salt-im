import React from 'react'
import './ListTagColumn.scss'
import Tag from '../Tag/Tag.js'
// import CreateTag from '../CreateTag/CreateTag.js'


export const ListTagColumn = (props) => {
    const tagsNode = props.data.map( (elmt,i) => (
        <Tag key={i} data={elmt}/>
    ))

    return (
      <div className="tagsColumn">
        
        <div className="tagsColumn__list">
            {tagsNode}
        </div>

     </div>
    )
}

export default ListTagColumn
