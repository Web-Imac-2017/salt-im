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
            resultsTag:{},
            resultsUser:{}
        };

        if('http://localhost:3000/' == window.location.href)
            this.state.isOpen = true;

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
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            isOpen:nextProps.isOpen
        })
    }

    render() {
        console.log(this.state.isOpen)
        let classes = "bigsearch";
        let resultClass = "results";
        let noResult = <div> Aucun résultat trouvé </div>;

        if(this.state.isOpen){
            classes += " bigsearch--open"
        }

        if(this.state.search != "" && this.state.isOpen)
            resultClass +=" results--open"

        let nodeSearch = (<div/>)
        if(this.state.results.length) {
            nodeSearch = this.state.results.map((elmt,i) => {
                var url = "/post/"+elmt.id

                return(
                    <div>
                        <li key={i}><Link to={url} onClick={this.handleLinkClick.bind(this)}>{elmt.title}</Link></li>
                    </div>
                )
            })
        }
        else {
            nodeSearch = noResult;
        }

        let nodeSearchTags = (<div/>)
        if(this.state.resultsTag.length) {
            nodeSearchTags = this.state.resultsTag.map((elmt,i) => {
                let url = "/tag/"+elmt.id
                return(
                    <div>
                        <li key={i}><Link to={url} onClick={this.handleLinkClick.bind(this)}>{elmt.name}</Link></li>
                    </div>
                )
            })
        }
        else {
            nodeSearchTags = noResult
        }

        let nodeSearchUsers = (<div/>)
        if(this.state.resultsUser.length) {
            nodeSearchUsers = this.state.resultsUser.map((elmt,i) => {
                let url = "/u/"+elmt.id
                return(
                    <div>
                        <li key={i}><Link to={url} onClick={this.handleLinkClick.bind(this)}>{elmt.username}</Link></li>
                    </div>
                )
            })
        }
        else {
            nodeSearchUsers = noResult
        }

        return (
            <div>
                <div className={classes}>
                    <form ref="form">
                        <input type="text" name="search" onChange={this.handleChangeSearch.bind(this)} placeholder="Rechercher un post, un tag, un utilisateur..."/>
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
                        </div>
                    </div>

                </div>
            </div>

        );
    }
}

export default BigSearch;
