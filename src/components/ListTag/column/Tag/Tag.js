import React from 'react'
import './Tag.scss'

export const Tags = (props) => (
    <div className="list__column__tag">

    	<div className="list__column__tag__img">
        		<a href={props.link}><img src={props.picUrl} height="42" width="42"></a>
    	</div>

    	<div className="list__column__tag__title">
        		{props.title}
       	</div>

    </div>
)

export default Tags
