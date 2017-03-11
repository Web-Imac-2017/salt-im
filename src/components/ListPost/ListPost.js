import React from 'react'
import './ListPost.scss'
import PostPreview from './PostPreview/PostPreview.js'

export const ListPost = (props) => {
    if(!props.data.length)
        return (<div className="listpost--empty">T'es comme le "ç" de sel, t'existe pas</div>)
    let postsNode = props.data.map( (elmt,i) => (
        <PostPreview key={i} data={elmt}/>
    ))

    return (
        <div className="listpost">
          <div className="listpost__postwrapper">
            {postsNode}
          </div>
        </div>
    )
}

export default ListPost
