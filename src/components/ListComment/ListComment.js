import React from 'react'
import './ListComment.scss'
import Comment from './Comment/Comment.js'

export const ListComment = (props) => {

    let commentsNode = props.data.map( (elmt,i) => (
        <Comment key={i} data={elmt}/>
    ))

    return (
        <div className="listComment">
          <div className="listComment__commentwrapper">
            {commentsNode}
          </div>
        </div>
    )
}

export default ListComment
