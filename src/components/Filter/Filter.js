import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './Filter.scss'

export default class Filter extends Component{
    constructor(props) {
        super(props);

        this.state = {
            value: 0
        };
    }

    change = (e) => {
        this.setState({idStat : e.target.value})
    }

    render(){
        return(
            <div className="select">
                <span className="select__text">Filtrer par</span>
                <div className="select__wrap">
                    <select className="select__input" onChange={this.change} value={this.state.value}>
                        <option value={0}>taux de sel</option>
                        <option value={1}>taux de poivre</option>
                        <option value={2}>taux d'humour</option>
                        <option value={3}>date</option>
                    </select>
                </div>
            </div>
        )
    }
}
