import React from 'react'
import {Link} from 'react-router'
import './Tag.scss'

export const Tag = (props) => {
    const backgroundUrlStyle = {
        backgroundImage: "url("+props.data.img_url+")"
    }

    if(props.line){
        return(
            <div className="tag">

                <div className="tag__title">
                    > {props.data.name}
                </div>

            </div>
        )
    }

    else if(props.solo){
        return(
            <div className="tag">
                <http://localhost/salt-im/api/tag/0div className="tag__title">
                    > {props.data.name}
                </div>
                <div className="tag__description">{props.data.description}</div>
            </div>
        )
    }
    let link = "/tag/" + props.idTag;

    return(
        <div className="tag">

            <Link to={link}>
                <div className="tag__img" style={backgroundUrlStyle}></div>
            </Link>

            <div className="tag__title">
                {props.data.name}
            </div>

        </div>
    )
}

export default Tag
