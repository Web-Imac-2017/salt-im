import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'

import PreviewShare from './PreviewShare/PreviewShare.js'
import './PreviewActions.scss'

import utils from '../../../../../public/utils.js'

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

    clicked = (e) => {
        let ok = e.target,
            name = ok.dataset.name;
        e.target.classList.add("circle-animation");
        setTimeout(()=>{ok.classList.remove("circle-animation")}, 500);

        this.vote(name);
    }

    vote(id) {
        let newData;
        console.log(id)
        switch(id) {
            case 0 :
                newData = new FormData(this.refs.formSalt)
                break;
            case 1 :
                newData = new FormData(this.refs.formPepper)
                break;
            case 2 :
                newData = new FormData(this.refs.formLol)
                break;
            default :
                newData = new FormData(this.refs.formLol)
                break;
        }

        //if(!newData) return;

        fetch(utils.getFetchUrl()+"/p/"+this.props.data.id+"/stat/up/"+id, {
                method: "post",
                body: newData,
            })
            .then((data) => data.text())
            .then((object) => {console.log(object)})
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
                if(this.props.stats[i])
                    return this.props.stats[i].value;
                else
                    return "no_data";
        }
        else{
            return "no data";
        }

    }


    statValueId=(i)=>{
        if(!this.props.stats)
            return
        if(this.props.stats[i])
            return this.props.stats[i].value;
        else
            return "";
    }

    render() {

        let iconClass = "preview__action__reaction icones";

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
                    <div className={'preview__action__icon icon icon--salty'}/>
                    <div className="preview__action__value">{this.statValue}</div>
                    {true ? (
                        <div className="preview__action__reactions">
                            <div className="preview__action__reactionwrapper">
                                <div className="icon__wrapper">
                                    <div ref="salt" onClick={this.clicked} data-name={0} className={iconClass}>
                                        <form ref="formSalt">
                                            <input type="hidden" value={this.props.dataUser ? this.props.dataUser.id : 0} name="user_id"/>
                                        </form>
                                    </div>
                                    <div className="statAction">{this.statValueId(0)}</div>
                                </div>
                                <div className="icon__wrapper">
                                    <div ref="pepper" onClick={this.clicked} data-name={1} className={iconClass}>
                                        <form ref="formPepper">
                                            <input type="hidden" value={this.props.dataUser ? this.props.dataUser.id : 0} name="user_id"/>
                                        </form>
                                    </div>
                                    <div className="statAction">{this.statValueId(1)}</div>
                                </div>
                                <div className="icon__wrapper">
                                    <div ref="lol" onClick={this.clicked} data-name={2} className={iconClass}>
                                        <form ref="formLol">
                                            <input type="hidden" value={this.props.dataUser ? this.props.dataUser.id : 0} name="user_id"/>
                                        </form>
                                    </div>
                                    <div className="statAction">{this.statValueId(2)}</div>
                                </div>
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

