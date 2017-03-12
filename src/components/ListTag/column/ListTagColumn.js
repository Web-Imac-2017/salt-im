import React from 'react'
import './ListTagColumn.scss'
import Tag from '../Tag/Tag.js'
// import CreateTag from '../CreateTag/CreateTag.js'


export const ListTagColumn = (props) => {
    if(props.data.map != undefined  ){
        let tagsNode = props.data.map( (elmt,i) => {
            if(i < 10)
                return (<Tag key={i} data={elmt}/>);
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
            <div>Chargement des tags</div>
        )

    }
}

    export default ListTagColumn
