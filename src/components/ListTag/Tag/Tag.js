import React from 'react'
import {Link} from 'react-router'
import './Tag.scss'

export const Tag = (props) => {
    console.log(props)
    return(
        <div className="list__column__tag">

            <div className="list__column__tag__img">
                <Link to={props.data.link}>
                    <img src={props.data.picUrl} height="42" width="42" />
                </Link>
            </div>

            <div className="list__column__tag__title">
                {props.data.title}
            </div>

        </div>
    )
}

export default Tag