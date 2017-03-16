import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './Pseudo.scss'


export default class Pseudo extends Component{
	constructor(props) {
        super(props);

        this.state = {
            isLogged:false,
        };
    }
    render() {
    	return(
    	<div>
    		<p className="user__name">{this.props.dataUser.username}</p>
    	</div>
    	)
    }

}






