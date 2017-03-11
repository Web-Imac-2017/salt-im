import './ListComment.scss'
import Comment from './Comment/Comment.js'
import React, { Component } from 'react';
import { Link } from 'react-router';

export default class ListComment extends Component {
    constructor(props) {
      super(props);

      this.state = {
        commentData:{},
        repeat:true
      };
    }

    componentWillReceiveProps(nextProps) {
        return;
        if(this.state.repeat == true){
            fetch('http://localhost/salt-im/api/p/comment/'+nextProps.id)
                .then((response) => response.json())
                .then((data) => {
                    this.props.getNbComments(data.length);
                    this.setState({commentData:data, repeat:false});
                })
        }
    }

    render() {
        let commentsNode = (<div>Personne n est salé ici.</div>)

        if(!this.props.data){
            if(this.state.commentData.length) {
                commentsNode = this.state.commentData.map((elmt,i) => {
                    return (<Comment key={i} data={elmt}/>)
                })
            }
        } else {
            commentsNode = this.props.data.map((elmt,i) => {
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
