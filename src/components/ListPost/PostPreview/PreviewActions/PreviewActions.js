import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'

import PreviewShare from './PreviewShare/PreviewShare.js'
import './PreviewActions.scss'

export default class PreviewActions extends Component {
    constructor(props) {
      super(props);

      this.state = {
        isShareActive:false,
        iconIsClicked:false,
      };
    }

    toggleShare() {
        if(this.state.isShareActive)
            this.setState({isShareActive:false});
        else
            this.setState({isShareActive:true});
    }

    statMax=()=>{
        var param = this.props.stats;
        if(!param)
            return;


        var maxIndex = 0;
        for(var i = 1; i < param.length; i++){
            var val = parseInt(param[i].value);
            var max = parseInt(param[maxIndex].value);
            if( val > max){
                maxIndex = i;
            }
        }

        switch(maxIndex){
            case 1:
                return "pepper"
            break;
            case 2:
                return "lol"
            break;
            default:
                return "salt"
            break;
        }

    }

    clicked = () => {
        this.setState({IconIsClicked:true});
    }

    statMaxId=()=>{
        var param = this.props.stats;

        if(!param)
            return;

        var maxIndex = 0;
        for(var i = 1; i < param.length; i++){
            var val = parseInt(param[i].value);
            var max = parseInt(param[maxIndex].value);
            if(val > max){
                maxIndex = i;
            }
        }

       return maxIndex;

    }

    statValue=()=>{

        if(this.props.stats){
                var i = this.statMaxId();
                if(this.props.stats[i]){
                    return this.props.stats[i].value;
                }
                else{
                    return "no_data";
                }
        }
        else{
            return "no data";
        }

    }

    statValueId(i) {
        if(!this.props.stat) return;
        if(this.props.stats[i]){
            return this.props.stats[i].value;
        }
        else{
            return "";
        }



    }

    render() {

        let iconClass = "preview__action__reaction icones";
        this.state.IconIsClicked ? iconClass+=" circle-animation" : "";

        return(
            <div className="preview__actions">
                <div className="preview__action">
                    <div className="preview__action__icon icon icon--comment"/>
                    <div className="preview__action__value">
                        {this.props.nbComment}
                    </div>
                </div>
                <div className="preview__action" onClick={this.toggleShare.bind(this)}>
                    <div className="preview__action__icon icon icon--share"/>
                </div>
                <div className="preview__action">
                    <div className="preview__action__icon icon icon--favorite"/>
                </div>
                <div className="preview__action preview__action--salty">
                    <div className={'preview__action__icon icon icon--'+this.statMax()}/>
                    <div className="preview__action__value">{this.statValue}</div>
                    {this.props.dataUser ? (
                        <div className="preview__action__reactions">
                            <div className="preview__action__reactionwrapper">
                                <div onClick={this.clicked} className={iconClass}></div>
                                {this.statValueId(0)}
                                <div onClick={this.clicked} className={iconClass}></div>
                                {this.statValueId(1)}
                                <div onClick={this.clicked} className={iconClass}></div>
                                 {this.statValueId(2)}
                            </div>
                            <div className="preview__action__arrow"/>
                        </div>
                    ):(<div/>)}
                </div>
                <PreviewShare data={this.props.data} isActive={this.state.isShareActive} closeShare={this.toggleShare.bind(this)}/>
            </div>
        )
    }
}

