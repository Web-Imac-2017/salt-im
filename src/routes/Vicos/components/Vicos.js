import React, {Component} from 'react'
import {Link} from 'react-router'
import './Vicos.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import Filter from '../../../components/Filter/Filter.js'


export default class VicosView extends Component {

    constructor(props) {
    super(props);

    this.state = {
      postdata:{},
    };
  }

  componentDidMount() {

    const myInit = {method: 'POST'};

    fetch('http://www.json-generator.com/api/json/get/bOGBOsLZfm?indent=2', myInit)
    .then((response) => response.json())
    .then((object) => { this.setState({postdata: object})})

  }

  render() {
        return (
        <div className="center">
          <div className="vicos">
            <h1 className="vicos__title">Cimetière des Vicos</h1>
            <p className="vicos__subtitle">Apportez un peu de votre répartie à ces personnes en détresse !</p>
            <ListPost className="vicos__postpreview" data={this.state.postdata} />

          </div>
        </div>
        )

  }

}

  
