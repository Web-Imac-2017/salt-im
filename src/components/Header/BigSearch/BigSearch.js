import React, { Component } from 'react';
import { Link } from 'react-router';
import './BigSearch.scss'

import utils from "../../../../public/utils.js";

class BigSearch extends Component {
  constructor(props) {
    super(props);

    this.state = {
        isOpen:false,
        search:"",
        results:{},
    };
  }

  handleChangeSearch(event){
    this.setState({search: event.target.value});
    fetch(utils.getFetchUrl()+'/search/p/' + event.target.value,
              {
                  method: "post",
                  body: new FormData(this.refs.formA),
              })
            .then( (response) => response.json())
            .then( (data) => {this.setState({results:data})});


  }

  componentWillReceiveProps(nextProps) {
      this.setState({
        isOpen:nextProps.isOpen
      })
  }

  render() {
    console.log(this.state.results);
    let classes = "bigsearch";
    let resultClass = "results";

    if(this.state.isOpen)
    {
        classes += " bigsearch--open"
    }

    if(this.state.search != "")
      resultClass +=" results--open"

    return (
      <div>
        <div className={classes}>
          <form ref="form">
              <input type="text" name="search" onChange={this.handleChangeSearch.bind(this)} placeholder="Search"/>
          </form>
        </div>

        <div className={resultClass}>

          <div className="results__fetch">
            <div className="results__wrapper">
              <h1> Posts </h1>
                <ul>
                  <li>manger des pates</li>
                  <li>manger des anus</li>
                  <li>manger la chatte à la voisine</li>
                  <li>manger son sexe</li>
                </ul>
            </div>
          </div>

          <div className="results__fetch">
            <div className="results__wrapper">
              <h1> Tags </h1>
                <ul>
                  <li>manger des pates</li>
                  <li>manger des anus</li>
                  <li>manger la chatte à la voisine</li>
                  <li>manger son sexe</li>
                  <li>manger des pates</li>
                  <li>manger des anus</li>
                  <li>manger la chatte à la voisine</li>
                  <li>manger son sexe</li>
                  <li>manger des pates</li>
                  <li>manger des anus</li>

                </ul>

                <span className="results__seeall"> Voir tout </span>
            </div>
          </div>

          <div className="results__fetch">
            <div className="results__wrapper">
              <div className="results__titleline">
                <h1 className='results__titleline__title'> Vicos </h1>

              </div>
                <ul>
                  <li>manger des pates</li>
                  <li>manger des anus</li>
                  <li>manger la chatte à la voisine</li>
                  <li>manger son sexe</li>
                </ul>

                <span className="results__seeall"> Voir tout </span>
            </div>
          </div>

        </div>
      </div>

    );
  }
}

export default BigSearch;
