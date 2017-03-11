import React from 'react'
import './Wave.scss'

export const Wave = (props) => {
    let higher = props.salt,
        classes = "salt";
    if(props.pepper>higher)
        classes = "pepper";

    return(
        <div className='box'>
          <div className="salt">
            <div className='wave -one'> </div>
          </div>
        </div>
    )

}

export default Wave

