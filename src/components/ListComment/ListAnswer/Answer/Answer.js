import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Answer.scss'

export const Answer = (props) => {
    
    const backgroundUrlStyle = {
        backgroundImage: "url("+props.data.userPic+")"
    }

    return(
        <div className="answer">
            <div className="answer__left">
                <div className="answer__left__userPic" style={backgroundUrlStyle}></div>
                <div className="answer__left__saltBtn">btn</div>
                <div className="answer__left__salt">{props.data.salt}</div>
            </div>
            <div className="answer__right">
                <h1 className="answer__right__username">{props.data.user}</h1>
                <h2 className="answer__right__date">{props.data.date}</h2>
                <p className="answer__right__message">{props.data.message}</p>
            </div>
        </div>
    )

}

export default Answer

