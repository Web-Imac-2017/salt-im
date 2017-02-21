import React from 'react'
import Tags from '../../../../../components/ListPost/PostPreview/Tags/Tags.js'

export const MainData = (props) => (
    <div className="maindata">
        <div className="data__title">{props.data.title}</div>
        <div className="data__description">{props.data.description}</div>
        <Tags data={props.data.tags}/>
    </div>
)

export default MainData
