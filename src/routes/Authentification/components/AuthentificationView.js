import React, {Component} from 'react'
import {Link} from 'react-router'

import SignupView from "./SignupView.js";
import SignIn from "./SignIn.js";

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export default class AuthentificationView extends Component {
    render() {
        return(
            <div className="postcreator center">
              <SignIn/>
              <SignupView/>

            </div>
        )
    }
}
