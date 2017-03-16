import React, { Component } from 'react';
import { IndexLink, Link } from 'react-router';
import './BigSearch.scss'

import utils from "../../../../public/utils.js";

class BigSearch extends Component {
  constructor(props) {
    super(props);

    this.state = {
        isOpen:false,
        search:"",
        results:{},
        resultsTag:{},
        resultsUser:{}
    };

  }

  handleLinkClick() {
    this.props.handleClose();
  }

  handleChangeSearch(event){
    this.setState({search: event.target.value});
    fetch(utils.getFetchUrl()+'/search/p/' + event.target.value,
      {
          method: "post",
          body: new FormData(this.refs.form),
      })
      .then( (response) => response.json())
      .then( (data) => {this.setState({results:data})});

      fetch(utils.getFetchUrl()+'/search/t/' + event.target.value,
      {
          method: "post",
          body: new FormData(this.refs.form),
      })
      .then( (response) => response.json())
      .then( (data) => {this.setState({resultsTag:data})});
      // fetch(utils.getFetchUrl()+'/search/u/' + event.target.value,
      // {
      //     method: "post",
      //     body: new FormData(this.refs.form),
      // })
      // .then( (response) => response.json())
      // .then( (data) => {console.log(data);this.setState({resultsUser:data})});
  }

  componentWillReceiveProps(nextProps) {
      this.setState({
        isOpen:nextProps.isOpen
      })
  }

  render() {
    
    let classes = "bigsearch";
    let resultClass = "results";

    if(this.state.isOpen || 'http://localhost:3000/' == window.location.href){
        classes += " bigsearch--open"
    }

    if(this.state.search != "" && this.state.isOpen)
      resultClass +=" results--open"

    let nodeSearch = (<div/>)
    if(this.state.results.length) {
      nodeSearch = this.state.results.map((elmt,i) => {
        var url = "/post/"+elmt.id

        return(
          <li key={i}><Link to={url} onClick={this.handleLinkClick.bind(this)}>{elmt.title}</Link></li>
        )
      })
    }

    let nodeSearchTags = (<div/>)
    if(this.state.resultsTag.length) {
      nodeSearchTags = this.state.resultsTag.map((elmt,i) => {
        let url = "/tag/"+elmt.id
        return(
          <li key={i}><Link to={url} onClick={this.handleLinkClick.bind(this)}>{elmt.name}</Link></li>
        )
      })
    }

    let nodeSearchUsers = (<div/>)
    if(this.state.resultsUser.length) {
      nodeSearchUsers = this.state.resultsUser.map((elmt,i) => {
        let url = "/u/"+elmt.id
        return(
          <li key={i}><Link to={url} onClick={this.handleLinkClick.bind(this)}>{elmt.username}</Link></li>
        )
      })
    }

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
                  {nodeSearch}
                </ul>
            </div>
          </div>

          <div className="results__fetch">
            <div className="results__wrapper">
              <h1> Tags </h1>
                <ul>
                  {nodeSearchTags}
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
                  {nodeSearchUsers}
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
