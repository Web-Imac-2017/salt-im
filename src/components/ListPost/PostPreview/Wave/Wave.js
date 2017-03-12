import React, {Component} from 'react'
import './Wave.scss'

export default class Wave extends Component {
    componentDidMount() {
        let val = 10;
        if(val >= 10) {
            this.refs.wave.style.animationDuration = "3s";
            this.refs.wave.style.bottom = "40%";
        }
    }

    render() {
        let higher = this.props.salt,
            classes = "salt";
        if(this.props.pepper>higher)
            classes = "pepper";

        return(
            <div className='box'>
              <div className="salt">
                <div className='wave -one' ref="wave"/>
              </div>
            </div>
        )
    }
}
