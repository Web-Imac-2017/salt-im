import React, {Component} from 'react'
import VideoData from './VideoData/VideoData.js'
import PicData from './PicData/PicData.js'
import TextData from './TextData/TextData.js'
import LinkData from './LinkData/LinkData.js'

export default class PostData extends Component {
    constructor(props) {
      super(props);

      this.state = {
        dataMedia:{},
        dataUser:""
      };
    }

    loadUser(id) {
        fetch('http://localhost:8888/salt-im/api/u/name/'+id)
          .then((response) => response.json())
          .then((object) => {
            this.setState({dataUser: object})
          })
    }

    componentWillReceiveProps(nextProps) {
        const myInit = {method: 'POST'};
        console.log(nextProps.data)
        fetch('http://localhost:8888/salt-im/api/media/'+nextProps.data.media_id)
          .then((response) => response.json())
          .then((object) => {
            this.setState({dataMedia: object})
            // this.loadUser(nextProps.data.user_id);
          })
    }
    render() {
        let nodeData;
        if(!this.state.dataMedia)
            nodeData = (<TextData data={this.props.data} dataMedia={this.state.dataMedia} dataUser={this.state.dataUser} nbComment={this.props.nbComment}/>);
        else {
            switch(this.state.dataMedia.type) {
                case "video":
                    nodeData = (<VideoData data={this.props.data} dataMedia={this.state.dataMedia} dataUser={this.state.dataUser} nbComment={this.props.nbComment}/>);
                    break;
                case "img":
                    nodeData =(<PicData data={this.props.data} dataMedia={this.state.dataMedia} dataUser={this.state.dataUser} nbComment={this.props.nbComment}/>)
                    break;
                case "link":
                    nodeData = (<LinkData data={this.props.data} dataMedia={this.state.dataMedia} dataUser={this.state.dataUser} nbComment={this.props.nbComment}/>);
                    break;
                default:
                    nodeData = (<TextData data={this.props.data} dataMedia={this.state.dataMedia} dataUser={this.state.dataUser} nbComment={this.props.nbComment}/>);
                    break;
            }
        }

        let help = (<div/>);
        if(this.props.data.type == "u")
            help = (<div className="help">This man needs help</div>);

        return(
          <div className="postdata">
            <div className="postdata__top">
                <div className="content-wrapper">
                    {nodeData}
                    <div className="postdata__signal">signaler</div>
                </div>
            </div>
          </div>
        )
    }
}
