import React, {Component} from 'react'
import MainData from '../MainData/MainData.js'
import utils from '../../../../../../public/utils.js';

export default class VideoData extends Component {

    constructor(props){
        super(props);
        this.state = {
            isModalActive : false
        }
    }

    handleClick() {
        if(this.state.isModalActive)
            this.setState({isModalActive:false})
        else
            this.setState({isModalActive:true})
    }

    render() {
        let ytUrl = utils.youtube_parser(this.props.dataMedia.link);
        let picUrl = "https://img.youtube.com/vi/"+ytUrl+"/0.jpg" || "/default/video.svg";
        let classes = 'bigger';

        if (this.state.isModalActive)
            classes += ' bigger--active';
        return(
            <div className="videodata flex">
                <div onClick={this.handleClick.bind(this)} className="videodata__left flex-3">
                    <div className="iframeWrapper">
                        <img src={picUrl}/>
                    </div>
                </div>
                <div className={classes} onClick={this.handleClick.bind(this)}>
                    <div className="bigger__filter"/>
                    <img src="/close.svg" className="bigger__close" />
                    <div className="bigger__wrapper">
                        <div className="iframeWrapper">
                            <iframe src={"https://www.youtube.com/embed/"+ytUrl+"?ecver=2"} width="480" height="360" frameborder="0" allowFullScreen></iframe>
                        </div>
                    </div>
                </div>

                <div className="videodata__right flex-7">
                    <MainData data={this.props.data} dataUser={this.props.dataUser} nbComment={this.props.nbComment}/>
                </div>
            </div>
        )
    }
}
