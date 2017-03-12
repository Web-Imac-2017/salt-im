import React, { Component } from 'react'
import { Link } from 'react-router';
import './TagView.scss'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'
import ListTagLine from '../../../components/ListTag/line/ListTagLine.js'
import TagData from './TagData/TagData.js'

/*
 "title":"Nasa",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tag/nasa"
*/
export default class TagView extends Component {
  constructor(props) {
    super(props);

    this.state = {
      tagdata:{},
      size: "small"
    };
  }

  componentDidMount() {

    const myInit = {method: 'POST'};
    
    //fetch('http://localhost/salt-im/api/p/'+this.props.params.tagId, myInit)
    fetch('http://www.json-generator.com/api/json/get/ctAJIBmiUO?indent=2', myInit)
    .then((response) => response.json())
    .then((object) => { this.setState({tagdata: object})})
  }

  render() {
    
    return (
      <div className="tagview">
      <p className="tagview__titleTrends">Tags tendances</p>
      <ListTagColumn data={this.state.tagdata } />
      
      <p className="tagview__titleAll">Retrouvez tous les tags</p>
      <ListTagLine data={this.state.tagdata} size={this.state.size}/>

      </div>
    );
  }
}


