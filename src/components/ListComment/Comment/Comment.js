import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './Comment.scss'
import ListAnswer from '../ListAnswer/ListAnswer.js'

import utils from "../../../../public/utils.js"

export default class Comment extends Component {
    constructor(props) {
      super(props);

      this.state = {
        user : "",
        isCommentShown:false,
      };
    }

    toggleComment() {
        if(this.state.isCommentShown)
            this.setState({isCommentShown:false})
        else
            this.setState({isCommentShown:true})
    }

    componentDidMount() {
        fetch(utils.getFetchUrl()+"/u/"+this.props.data[0].user_id)
            .then((data) => (data.json()))
            .then((object) => {
                this.setState({user:object})
            })
    }

    handleSubmit(e) {
        e.preventDefault();
        let url = "/comment/add/comment/"+this.props.data[0].id;

        fetch(utils.getFetchUrl()+url,
            {
                method: "post",
                body: new FormData(this.refs.form),
            })
            .then( (data) => data.text())
            .then( (object) => {
                console.log(object)
            })

    }

    render() {
        let url = this.state.user.avatar || "/avatar.png";
        const backgroundUrlStyle = {
            backgroundImage: "url("+ url +")"
        }

        return(
            <div>
                <div className="comment comment_block">
                    <div className="comment__wrapper">
                        <div className="comment__left">
                            <div className="comment__left__userPic" style={backgroundUrlStyle}></div>
                            <div className="comment__left__saltBtn">btn</div>
                            <div className="comment__left__salt">{this.props.data[0].salt}</div>
                        </div>
                        <div className="comment__right">
                            <h1 className="comment__right__username">{this.state.user.username}</h1>
                            <h2 className="comment__right__date">{this.props.data[0].date}</h2>
                            <p className="comment__right__message">{this.props.data[0].text}</p>
                        </div>
                    </div>
                    <div className="comment__answer" onClick={this.toggleComment.bind(this)}>répondre</div>
                    <form ref="form" onSubmit={this.handleSubmit.bind(this)} className={this.state.isCommentShown ? "comment__form comment__form--active" : "comment__form"}>
                        <textarea type="text" name="text" cols="4"/>
                        <input type="submit" value="envoyer"/>
                    </form>

                </div>
                <ListAnswer data={this.props.data[1]}/>
            </div>
        )
    }
}
