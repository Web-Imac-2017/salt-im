import React from 'react'
import MainData from '../MainData/MainData.js'
import './LinkData.scss'

export const LinkData = (props) => (
    <div className="linkdata flex">
        <div className="linkdata__left flex-3" style={{backgroundImage: 'url(' + "http://www.smashbros.com/images/og/link.jpg" + ')'}}/>
        <div className="linkdata__right flex-7">
            <MainData data={props.data} nbComment={this.props.nbComment}/>
        </div>
    </div>
)

export default LinkData
