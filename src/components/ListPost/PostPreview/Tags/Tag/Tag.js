import React, {Component} from 'react'
import {Link} from 'react-router'
import './Tag.scss'

export default class Tag extends Component {
    render() {
        let url = "/tag/"+this.props.data.toLowerCase();
        return(
                <Link to={url} className="preview__tag">
                    #{this.props.data}
                </Link>
        )
    }
}
