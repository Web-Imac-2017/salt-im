import React from 'react'
import Answer from './Answer/Answer.js'


export const ListAnswer = (props) => {

    let answerNode = props.data.map( (elmt,i) => (
        <Answer key={i} data={elmt}/>
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
