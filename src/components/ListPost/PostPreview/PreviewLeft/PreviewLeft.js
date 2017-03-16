import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './PreviewLeft.scss'
import utils from '../../../../../public/utils.js'

export default class PreviewLeft extends Component {

    render() {
        let picUrl = "/defaults/video.svg"

        if(this.props.data){
            switch(this.props.data.type){
                case "img":
                    picUrl = this.props.data.link;
                    break;
                case "video":
                    picUrl = "https://img.youtube.com/vi/"+utils.youtube_parser(this.props.data.link)+"/0.jpg" || "/default/video.svg";
                    break;
                default:
                    break;
            }
        }

        let divStyle = {
            backgroundImage: 'url(' + picUrl + ')'
        }

        let urlToPost = "/post/"+this.props.id;


        return(
            <Link to={urlToPost} className="preview__background" style={divStyle}/>
        )
    }
}

