import React, { Component } from 'react';
import { Link } from 'react-router';
import './PostView.scss'
import '../../Tags/components/TagView.scss'
import PostData from './PostData/PostData.js'
import ListComment from '../../../components/ListComment/ListComment.js'
import Filter from '../../../components/Filter/Filter.js'

import utils from '../../../../public/utils.js'

export default class PostView extends Component {
  constructor(props) {
    super(props);

    this.state = {
        postdata:{},
        nbComment:0,
    };
  }

  componentDidMount() {

    const myInit = {method: 'POST'};

    fetch(utils.getFetchUrl()+'/p/'+this.props.params.postId, myInit)
      .then((response) => response.json())
      .then((object) => { this.setState({postdata: object})})
  }

  handleNbComments(nb) {
    this.setState({nbComment:nb})
  }

  render() {
    return (
      <div className="post">
        <PostData data={this.state.postdata} nbComment={this.state.nbComment} dataUser={this.props.dataUser}/>
        <div className="post__commentBlock center">
            <p className="tagview__titleAll">Commentaires</p>
            <Filter/>
            <ListComment getNbComments={this.handleNbComments.bind(this)} id={this.state.postdata.id}/>
        </div>
      </div>
    );
  }
}
