import React from 'react'
import Tags from '../../../../../components/ListPost/PostPreview/Tags/Tags.js'
import "./MainData.scss";
import PreviewActions from '../../../../../components/ListPost/PostPreview/PreviewActions/PreviewActions.js'

export const MainData = (props) => {
    console.log(props.data.title)
    let dataLink = (<div/>);
    if(props.data.type == "link")
        dataLink = (<a target="_blank" href={props.data.url} className="data__link">Voir le lien</a>)

    return(
        <div className="data">
            <div className="data__author">{props.data.date} par {props.data.author}</div>
            <div className="data__title">{props.data.title}</div>
            <div className="data__description">{props.data.text}</div>
            {dataLink}
            <PreviewActions data={props.data}/>
        </div>
    )
}

export default MainData
