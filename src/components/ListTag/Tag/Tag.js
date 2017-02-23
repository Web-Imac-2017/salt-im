import React from 'react'
import {Link} from 'react-router'
import './Tag.scss'

export const Tag = (props) => {
    const backgroundUrlStyle = {
        backgroundImage: "url("+props.data.picUrl+")"
    }
    return(
        <div className="tag">

            <Link to={props.data.link}>
                <div className="tag__img" style={backgroundUrlStyle}></div>
            </Link>

            <div className="tag__title">
                {props.data.title}
            </div>

        </div>
    )
}

export default Tag