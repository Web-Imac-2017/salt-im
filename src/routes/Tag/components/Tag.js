import React, {Component} from 'react'
import {Link} from 'react-router'
import './Tag.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import '../../Tags/components/TagView.scss'
import Filter from '../../../components/Filter/Filter.js'
import TagData from './TagData/TagData.js'
import Tag from '../../../components/ListTag/Tag/Tag.js'

export default class TagSolo extends Component {

    constructor(props) {
    super(props);

    this.state = {
      tagdata:{},
      postdata:{},
      size: "small",
      solo: "solo"
    };
  }

  componentDidMount() {

    const myInit = {method: 'POST'};
 
    //fetch('http://localhost/salt-im/api/p/'+this.props.params.tagId, myInit)
    fetch('http://www.json-generator.com/api/json/get/cqxGmrzLyq?indent=2', myInit)
    .then((response) => response.json())
    .then((object) => { this.setState({tagdata: object})})

    fetch('http://www.json-generator.com/api/json/get/bOGBOsLZfm?indent=2', myInit)
    .then((response) => response.json())
    .then((object) => { this.setState({postdata: object})})

  }

  render() {
    console.log(this.state)
        return (

        <div className="tagSingle">
            <Tag key={0} data={this.state.tagdata} solo={this.state.solo}/>
            <p className="tagview__titleTrends">Posts les plus salés</p>

            <ListPost data={this.state.postdata} />

        </div>
        )

  }

}

  
