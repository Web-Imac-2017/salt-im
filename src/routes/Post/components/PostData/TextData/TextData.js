import React from 'react'
import MainData from '../MainData/MainData.js'

export const TextData = (props) => (
    <div className="textdata">
        <div className="textdata__text flex">
            <MainData data={props.data} nbComment={props.nbComment}/>
        </div>
    </div>
)

export default TextData
