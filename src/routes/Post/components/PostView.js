/*import React from 'react'
import ReactDOM from "react-dom";
import './PostView.scss'
import '../../Tags/components/TagView.scss'
import PostData from './PostData/PostData.js'
import ListComment from '../../../components/ListComment/ListComment.js'
import Filter from '../../../components/Filter/Filter.js'

// const dataPost = {
//     "id":1,
//     "type":"link",
//     "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
//     "title":"Super title putaclic sa mère",
//     "description":"Sa darrone ils boivent du sprite sa mère",
//     "salt":18,
//     "pepper":20,
//     "date":"12 jan. 2017",
//     "author":"Thomas Lerouô",
//     "tags":["boisson","mere"]
// }
*/

// dataPost = {
//     "id":1,
//     "type":"video",
//     "url":"https://www.youtube.com/watch?v=_dux_Ugs2lk",
//     "title":"Titre putaclic de sa mère qui boit du sprite",
//     "description":"Sa darrone ils boivent du sprite sa mère",
//     "salt":18,
//     "pepper":20,
//     "tags":["boisson","mere"]
// }

// let dataPost = {}
// const loadData = () => {
//     fetch('http://localhost:8888/salt-im/api/p/1')
//     .then(function(response) {
//       dataPost = response.text();
//       return dataPost;
//     })
//     .then(function(data) {
//         dataPost = data;
//     })
// }

// loadData();


// export const PostView = (props:dataPost) => {
//     console.log(props)
//     return(
//           <div className="post">
//             <PostData data={dataPost}/>

//             <div className="post__commentBlock center">
//                 <p className="tagview__titleAll">Commentaires</p>
//                 <Filter/>
//                 <ListComment data={dataComments}/>
//             </div>

//           </div>
//     )
// }

// export default PostView


import React, { Component } from 'react';
import { Link } from 'react-router';
import './PostView.scss'
import '../../Tags/components/TagView.scss'
import PostData from './PostData/PostData.js'
import ListComment from '../../../components/ListComment/ListComment.js'
import Filter from '../../../components/Filter/Filter.js'

class PostView extends Component {
  constructor(props) {
    super(props);

    this.state = {
        postdata:{},
        nbComment:0,
    };
  }

  componentDidMount() {
    let self=this;
    fetch('http://localhost:8888/salt-im/api/p/'+self.props.params.postId)
    .then(function(response) {
      let dataPost = response.json();
      return dataPost;
    })
    .then(function(data) {
      self.setState({postdata:data});
    })
  }

  handleNbComments(nb) {
    this.setState({
      nbComment:nb
    })
  }

  render() {
    return (
      <div className="post">
        <PostData data={this.state.postdata} nbComment={this.state.nbComment}/>
        <div className="post__commentBlock center">
            <p className="tagview__titleAll">Commentaires</p>
            <Filter/>
            <ListComment getNbComments={this.handleNbComments.bind(this)} id={this.state.postdata.id}/>
        </div>
      </div>
    );
  }
}

export default PostView;
