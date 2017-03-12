import React from 'react'
import {Link} from 'react-router'
import './Tag.scss'

export const Tag = (props) => {
    const backgroundUrlStyle = {
        backgroundImage: "url("+props.data.picUrl+")"
    }
    if(props.size){
        return(
            <div className="tag">

                <div className="tag__title tag--chevron">
                    {props.data.title}
                </div>

            </div>
        )
    }

    else if(props.solo && props.data[0] != undefined){
        return(
            <div className="tag">
                <div className="tag__title tag--chevron">
                <h1 className="tagSingle__title"> > {props.data[0].title}</h1>
                <p className="tagSingle__description">{props.data[0].description}</p>
                </div>

            </div>
        )
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