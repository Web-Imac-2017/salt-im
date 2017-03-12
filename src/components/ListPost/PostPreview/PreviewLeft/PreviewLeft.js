import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './PreviewLeft.scss'

export default class PreviewLeft extends Component {
    youtube_parser(url){
        let regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        let match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }

    render() {
        let picUrl = "/defaults/video.svg"

        switch(this.props.data.type){
            case "img":
                picUrl = this.props.data.url;
                break;
            case "video":
                picUrl = "https://img.youtube.com/vi/"+this.youtube_parser(this.props.data.url)+"/0.jpg" || "/default/video.svg";
                break;
            default:
                break;
        }

        let divStyle = {
            backgroundImage: 'url(' + picUrl + ')'
        }

        return(
            <div className="preview__background" style={divStyle}/>
        )
    }
}

