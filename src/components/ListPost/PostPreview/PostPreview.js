import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './PostPreview.scss'
import Tags from './Tags/Tags.js'
import PreviewLeft from './PreviewLeft/PreviewLeft.js'
import PreviewActions from './PreviewActions/PreviewActions.js'
import Wave from './Wave/Wave.js'

export default class PostPreview extends Component {
    constructor(props) {
      super(props);

      this.state = {
        dataUser:"",
        dataMedia:"",
        dataStat:{},
        score:this.props.state,
      };
    }

    loadUser(id) {
        fetch('http://localhost/salt-im/api/u/name/'+id)
            .then((response) => response.json())
            .then((object) => {
              this.setState({dataUser: object})
            })
    }

    loadMedia(id) {
        fetch('http://localhost/salt-im/api/media/'+id)
            .then((response) => response.json())
            .then((object) => {
              this.setState({dataMedia: object})
              this.loadUser(this.props.data.user_id);
              this.loadStat(this.props.data.user_id);
            })
    }

    loadStat(id) {
        fetch('http://localhost/salt-im/api/p/'+1+'/stat/') //à remplacer par id du post qd c gud
          .then((response) => response.json())
          .then((object) => {
            this.setState({dataStat: object})
          })
    }



    componentWillReceiveProps(nextProps) {
        this.loadUser(nextProps.data.user_id);
    }

    componentDidMount() {
        if(this.props.data){
            this.loadMedia(this.props.data.media_id);
        }
    }

    handleMax(val) {
        this.props.handleMax(val);
    }

    render() {
        console.log(this.props)
        return(
            <div className="preview">
                <div className="preview__left">
                    <PreviewLeft data={this.state.dataMedia} id={this.props.data.id}/>
                </div>
                <div className="preview__right">
                    <div className="preview__content">
                        <div className="preview__title">{this.props.data.title}</div>
                        <div className="preview__description">{this.props.data.text}</div>
                        <PreviewActions data={this.props.data} dataUser={this.props.dataUser} stats={this.state.dataStat}/>
                        <div className="preview__infos">
                            <div className="preview__author">{this.state.dataUser}</div>
                            <div className="preview__date">le {this.props.data.date}</div>
                        </div>
                    </div>

                    <Wave data={this.props.data} state={this.state.score} handleMax={this.handleMax.bind(this)} maxValue={this.props.maxValue}/>
                </div>
            </div>
        )
    }

}


//<Tags data={props.data.tags}/>
//
