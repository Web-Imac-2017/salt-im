import React from 'react'
import './ListTagLine.scss'
import Tag from '../Tag/Tag.js'

export const ListTagLine = (props) => {
    if(props.data.map != undefined  ){
        let tagsNode = props.data.map( (elmt,i) => (
            <Tag key={i} data={elmt} line={props.line}/>
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
                <div className="loader__wrapper">
                <div className="loader">
                    <img src="loader.gif" alt="Chargement des tags..." height="75" width="75"/>
                    <p>Chargement des tags</p>
                </div>
            </div>
            )
        }
}

export default ListTagLine
