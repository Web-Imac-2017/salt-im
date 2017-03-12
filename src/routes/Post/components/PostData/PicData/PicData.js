import React, {Component} from 'react'
import MainData from '../MainData/MainData.js'
import './PicData.scss'

export default class PicData extends Component {
    handleLoad() {
        let width = this.refs.pic.offsetWidth
        this.refs.pic.style.height = width + "px";
    }
    render() {
        if(!this.props.data)
            return (<div/>)
        return(
            <div className="picdata flex">
                <div ref="pic" className="picdata__left flex-3" style={{backgroundImage: 'url(' + this.props.dataMedia.link + ')'}}>
                    <img style={{display:"none"}} src={this.props.dataMedia.link} onLoad={this.handleLoad.bind(this)}/>
                </div>
                <div className="picdata__right flex-7">
                    <MainData data={this.props.data} dataUser={this.props.dataUser} nbComment={this.props.nbComment}/>
                </div>
            </div>
        )
    }
}
