import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import Pic from "./Pic/Pic.js"
import Pseudo from "./Pseudo/Pseudo.js"
import AuthentificationView from "../../../../routes/Authentification/components/AuthentificationView.js";

export default class Account extends Component{
    constructor(props) {
      super(props);

      this.state = {
        isLogged:false,
        isActive:false,
      };
    }

    toggleModal() {
        if(this.state.isActive)
            this.setState({isActive:false})
        else
            this.setState({isActive:true})
    }

    render() {
        if(!this.state.isLogged) {
            let classes = "modal ";
            if(this.state.isActive) classes+="modal--active"
            return (
                <div className="accountWrapper">
                    <Link style={{cursor:"pointer"}} to="/auth">
                       Authentification
                    </Link>
                    <div className={classes}>
                        <div className="modal__filter" onClick={this.toggleModal.bind(this)}/>
                        <div className="modal__wrapper">
                            <AuthentificationView/>
                        </div>
                    </div>
                </div>
            )
        }
        return (
            <div className="user">
              <Pseudo/>
              <Pic/>
            </div>
        )
    }
}

