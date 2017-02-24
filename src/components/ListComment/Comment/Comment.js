import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Comment.scss'
import ListAnswer from '../ListAnswer/ListAnswer.js'

export const Comment = (props) => {
    
    const backgroundUrlStyle = {
        backgroundImage: "url("+props.data.userPic+")"
    }

    if(props.data.answers) {
        return(
            <div className="comment_block">
                <div className="comment">
                    <div className="comment__left">
                        <div className="comment__left__userPic" style={backgroundUrlStyle}></div>
                        <div className="comment__left__saltBtn">btn</div>
                        <div className="comment__left__salt">{props.data.salt}</div>
                    </div>
                    <div className="comment__right">
                        <h1 className="comment__right__username">{props.data.user}</h1>
                        <h2 className="comment__right__date">{props.data.date}</h2>
                        <p className="comment__right__message">{props.data.message}</p>
                    </div>
                </div>

                <ListAnswer data={props.data.answers} />

            </div>
        )
    }

    return(
        <div className="comment comment_block">
            <div className="comment__left">
                <div className="comment__left__userPic" style={backgroundUrlStyle}></div>
                <div className="comment__left__saltBtn">btn</div>
                <div className="comment__left__salt">{props.data.salt}</div>
            </div>
            <div className="comment__right">
                <h1 className="comment__right__username">{props.data.user}</h1>
                <h2 className="comment__right__date">{props.data.date}</h2>
                <p className="comment__right__message">{props.data.message}</p>
            </div>
        </div>
    )

}

export default Comment

