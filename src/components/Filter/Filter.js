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
        console.log(e.target.value);
        this.setState({idStat : e.target.value})
        this.props.onChange(e.target.value)
    }

    render(){
        return(
            <div className="select">
                <span className="select__text">Filtrer par</span>
                <div className="select__wrap">
                    <select name="select" className="select__input" onChange={this.change}>
                      <option value={1} selected={this.state.value==1 ? "selected" : ""}>taux de sel</option>
                      <option value={2} selected={this.state.value==2 ? "selected" : ""}>taux de poivre</option>
                      <option value={3} selected={this.state.value==3 ? "selected" : ""}>taux d'humour</option>
                      <option value={4} selected={this.state.value==4 ? "selected" : ""}>date</option>
                    </select>
                </div>
            </div>
        )
    }
}
