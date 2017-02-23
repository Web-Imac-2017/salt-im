import React from 'react'
import './ListTagLine.scss'
import Tag from '../Tag/Tag.js'

export const ListTagLine = (props) => {
    
    let tagsNode = props.data.map( (elmt,i) => (
        <Tag key={i} data={elmt}/>
    ))

    return (
        <div className="tagsLine">
            <div className="tagsLine__list">
                {tagsNode}
            </div>
        </div>
    )
}

export default ListTagLine
