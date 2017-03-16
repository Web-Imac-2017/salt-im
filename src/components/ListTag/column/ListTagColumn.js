import React from 'react'
import './ListTagColumn.scss'
import Tag from '../Tag/Tag.js'

// import CreateTag from '../CreateTag/CreateTag.js'

export const ListTagColumn = (props) => {
    if(props.data.map != undefined  ){
        let tagsNode = props.data.map( (elmt,i) => {
            if(i < props.size)
                return (<Tag key={i} idTag={i} data={elmt}/>);
        })

        return (
            <div className="tagsColumn">
                <div className="tagsColumn__list">
                    {tagsNode}
                </div>
            </div>
        )
    }

    else {
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

export default ListTagColumn
