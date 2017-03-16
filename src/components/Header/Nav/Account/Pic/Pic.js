import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './Pic.scss'

export default class Pic extends Component{
	constructor(props) {
        super(props);

        this.state = {
            isLogged:false,
        };
    }
    render() {
    	return(
    	<div>
    		 <div className="user__img">{this.props.avatar}</div>
    	</div>
    	)
    }
	 
}

