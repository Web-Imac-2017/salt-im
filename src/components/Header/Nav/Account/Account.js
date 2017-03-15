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
        };
    }

    render() {
        if(!this.props.dataUser) {
            return (
                <div className="accountWrapper">
                    <Link style={{cursor:"pointer"}} to="/auth">
                        Authentification
                    </Link>
                </div>
            )
        }
        console.log(this.props.dataUser);
        return (
            <Link to={"/profile/"+this.props.dataUser.id} className="user">
                <Pseudo/>
                <Pic/>
            </Link>
        )
    }
}
