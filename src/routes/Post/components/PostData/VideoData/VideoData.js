import React, {Component} from 'react'
import MainData from '../MainData/MainData.js'

export default class VideoData extends Component {

    constructor(props){
        super(props);
        this.state = {
            isModalActive : false
        }
    }

    handleClick() {
        this.setState({isModalActive:true})
    }    

    youtube_parser(url){
        let regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        let match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }

    render() {
        let ytUrl = this.youtube_parser(this.props.dataMedia.link);
        return(
            <div className="videodata flex">
                <div onClick={this.handleClick.bind(this)} className="videodata__left flex-3">
                    <div className="iframeWrapper">
                        <iframe src={"https://www.youtube.com/embed/"+ytUrl+"?ecver=2"} width="480" height="360" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>

                <div className={classes}>
                    <div className="iframeWrapper">
                        <iframe src={"https://www.youtube.com/embed/"+ytUrl+"?ecver=2"} width="480" height="360" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>  

                <div className="videodata__right flex-7">
                    <MainData data={this.props.data} dataUser={this.props.dataUser} nbComment={this.props.nbComment}/>
                </div>
            </div>
        )
    }
}
