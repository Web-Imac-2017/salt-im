import React from 'react'
import MainData from '../MainData/MainData.js'
import './PicData.scss'

export const PicData = (props) => (
    <div className="picdata flex">
        <div className="picdata__left flex-3" style={{backgroundImage: 'url(' + props.data.url + ')'}}/>
        <div className="picdata__right flex-7">
            <MainData data={props.data} nbComment={this.props.nbComment}/>
        </div>
    </div>
)

export default PicData
