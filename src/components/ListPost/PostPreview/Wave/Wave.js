import React, {Component} from 'react'
import './Wave.scss'

const arrayRadiusWaves = [43,33,53];
const arraySpeedWaves  = [3,2,4];
const arrayColorsWaves = ["#0af","#2100ff","#00ffbe"];

export default class Wave extends Component {
    _higherWave:{
        "name":0,
        "value":10
    }

    constructor(props) {
      super(props);

      this.state = {
        higherWave:{},
      };
    }

    componentDidMount() {
        let val = 10;
        if(val >= 10) {
            this.refs.wave.style.animationDuration = "3s";
            this.refs.wave.style.bottom = "10%";
        }

        this.getHigherScore(this.props.state);
    }

    componentWillReceiveProps(nextProps) {
        this.animWave(this._higherWave, nextProps.maxValue)
    }

    animWave(wave,maxValue) {
        this.refs.wave.style.bottom = Math.min((this._higherWave.value/maxValue.value)*70,70) + "%";
        this.refs.wave.style.animationDuration = arraySpeedWaves[wave.name] +"s";
        this.refs.wave.style.borderRadius = arrayRadiusWaves[wave.name]+"%";
        this.refs.wave.style.background = arrayColorsWaves[wave.name];
    }

    getHigherScore(values) {
        let higherScore = 0,
            wichWave:{};
        values.map((elmt) => {
            if(elmt.value>higherScore){
                wichWave = elmt;
                higherScore = elmt.value;
            }
        });

        // this.setState({
        //     higherWave:wichWave
        // })
        this._higherWave = wichWave;
        this.animWave(wichWave, this.props.maxValue);
        this.props.handleMax(wichWave);
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
