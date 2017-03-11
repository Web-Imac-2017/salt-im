import React from 'react'
import './ListTagLine.scss'
import Tag from '../Tag/Tag.js'

export const ListTagLine = (props) => {
    /*const tagsNode = props.data.map( (elmt,i) => (
        <Tag key={i} data={elmt} size={props.size}/>
    ))*/
     let nodeData;
    console.log(props.data);

    return (
        <div className="tagsLine">
            <div className="tagsLine__list">
                {nodeData}
            </div>
        </div>
    )
}

export default ListTagLine
