import React from 'react'
import './ListPost.scss'
import PostPreview from './PostPreview/PostPreview.js'
import R from 'ramda'

export const ListPost = (props) => {
    
    let postsNode = props.data.map( (elmt,i) => (
        <PostPreview key={i} data={elmt}/>
    ))

    return (
        <div>
          <div className="listpost__title">{props.title}</div>
          <div className="listpost__postwrapper">
            {postsNode}
          </div>
        </div>
    )
}

export default ListPost
