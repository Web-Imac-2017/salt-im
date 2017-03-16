import './ListComment.scss'
import Comment from './Comment/Comment.js'
import React, { Component } from 'react';
import { Link } from 'react-router';

import utils from '../../../public/utils.js'

export default class ListComment extends Component {
    constructor(props) {
      super(props);

      this.state = {
        commentData:{},
        repeat:true
      };
    }

    loadAllComments(id) {
        fetch(utils.getFetchUrl()+'/p/comment/3')
            .then((response) => response.json())
            .then((data) => {
                this.props.getNbComments(data.length);
                this.setState({commentData:data});
            })
    }

    componentDidMount() {
        this.loadAllComments(this.props.id);
    }

    handleSubmit(e) {
        e.preventDefault();
        let url = "/comment/add/"+this.props.id;
        fetch(utils.getFetchUrl()+url,
            {
                method: "post",
                body: new FormData(this.refs.form),
            })
            .then( (data) => data.text())
            .then( (object) => {
                this.loadAllComments(this.props.id);
            })
    }

    render() {
        let commentsNode = (<div>Personne n est salé ici.</div>)

            if(this.state.commentData.length) {
                commentsNode = this.state.commentData.map((elmt,i) => {
                    return (<Comment key={i} data={elmt} isFirst={true} loadComments={this.loadAllComments.bind(this)}/>)
                })
            }
        return (
            <div className="listComment">
                <form ref="form" onSubmit={this.handleSubmit.bind(this)} className="gocomment">
                    <textarea type="text" name="text" rows="4"/>
                    <input className="listComment__submitButton" type="submit" value="envoyer"/>
                </form>
                <div className="listComment__commentwrapper">
                    {commentsNode}
                </div>
            </div>
        );
    }
}
