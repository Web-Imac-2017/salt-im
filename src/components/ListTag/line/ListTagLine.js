import React from 'react'
import './ListTagLine.scss'
import Tag from '../Tag/Tag.js'

export const ListTagLine = (props) => {
        console.log(props)
    if(props.data.map != undefined  ){
        let tagsNode = props.data.map( (elmt,i) => (
            <Tag key={i} data={elmt} size={props.size}/>
            ))

            return (
            <div className="tagsLine">
            <div className="tagsLine__list">
            {tagsNode}
            </div>
            </div>)
        }

        else
        {
            return (
            <div>Chargement des tags</div>
            )

        }
    }

    export default ListTagLine
