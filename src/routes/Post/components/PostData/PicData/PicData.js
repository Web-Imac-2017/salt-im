import React from 'react'
import MainData from '../MainData/MainData.js'

export const PicData = (props) => (
    <div className="picdata flex">
        <div className="picdata__left flex-4" style={{backgroundImage: 'url(' + props.data.url + ')'}}/>
        <div className="picdata__right flex-6">
            <MainData data={props.data}/>
        </div>
    </div>
)

export default PicData
