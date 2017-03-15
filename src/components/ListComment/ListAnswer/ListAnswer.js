import React from 'react'
import Answer from './Answer/Answer.js'
import Comment from '../Comment/Comment.js';


export const ListAnswer = (props) => {
    if(!props.data)
        return (<div/>)

    let answerNode = props.data.map( (elmt,i) => (
        <Comment key={i} data={elmt}/>
    ))

    return (
        <div className="listAnswer">
          <div className="listAnswer__answerwrapper">
            {answerNode}
          </div>
        </div>
    )
}

export default ListAnswer
