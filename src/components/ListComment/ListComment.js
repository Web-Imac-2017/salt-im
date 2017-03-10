import './ListComment.scss'
import Comment from './Comment/Comment.js'
import React, { Component } from 'react';
import { Link } from 'react-router';

class ListComment extends Component {
    constructor(props) {
      super(props);

      this.state = {
        commentData:{}
      };
    }

    componentWillReceiveProps(nextProps) {
        let self = this;
        fetch('http://localhost:8888/salt-im/api/p/comment/'+nextProps.id)
        .then(function(response) {
            console.log("dofkof")
          return JSON.stringify(response);
        })
        .then(function(data) {
            self.props.getNbComments(data.length);
            self.setState({commentData:data});
        })
    }

    componentDidMount() {
        let self = this;
        fetch('http://localhost:8888/salt-im/api/p/comment/1')
        .then(function(response) {
            console.log("dofkof")
          return response.json();
        })
        .then(function(data) {
            self.props.getNbComments(data.length);
            self.setState({commentData:data});
        })
    }


    render() {
        let commentsNode = (<div>Personne n est salé ici.</div>)
        if(this.state.commentData.length){
            commentsNode = this.state.commentData.map((elmt,i) => {
                return (<Comment key={i} data={elmt}/>)
            })
        }
      return (
        <div className="listComment">
            <div className="listComment__commentwrapper">
                {commentsNode}
            </div>
        </div>
      );
    }
}

export default ListComment;
