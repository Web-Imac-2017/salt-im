import React, {Component} from 'react'
import './ListPost.scss'
import PostPreview from './PostPreview/PostPreview.js'

export default class ListPost extends Component {
    render() {
        console.log(this.props.data);
        if(!this.props.data.length)
            return (<div className="listpost--empty">T'es comme le "ç" de sel, t'existe pas</div>)
        let postsNode = this.props.data.map( (elmt,i) => (
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
}
