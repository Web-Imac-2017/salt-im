import React from 'react'
import {Link} from 'react-router'
import './Tag.scss'

export const Tag = (props) => {
    const backgroundUrlStyle = {
        backgroundImage: "url("+props.data.img_url+")"
    }

    let link = "/tag/" + props.data.id;

    if(props.line){

        return(
            <div className="tag">
                <Link to={link}>
                    <div className="tag__title">
                        > {props.data.name}
                    </div>
                </Link>


            </div>
        )
    }

    else if(props.solo){

        return(
            <div className="tag">
                    <div className="tag__title">
                        > {props.data.name}
                    </div>
                    <div className="tag__description">{props.data.description}</div>
                
            </div>
        )
    }


    return(
        <div className="tag">

            <Link to={link}>
                <div className="tag__img" style={backgroundUrlStyle}></div>
            </Link>
            <Link to={link}>
                <div className="tag__title">
                    {props.data.name}
                </div>
            </Link>

        </div>
    )
}

export default Tag
