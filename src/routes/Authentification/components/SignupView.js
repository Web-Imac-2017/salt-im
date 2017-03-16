import React, {Component} from 'react'
import {Redirect, Link} from 'react-router'
import { browserHistory } from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

import utils from '../../../../public/utils.js'

export default class SignupView extends Component {
    constructor(props) {
        super(props);

        this.state = {
            mail:"",
            pseudo:"",
            password:"",
            isPseudoGood:"not",
            isPasswordGood:"not",
            passwordConf:false,
        };
    }

    handleChangeMail(event) {
        this.setState({mail: event.target.value});
    }

    handleChangePseudo(event) {
        this.setState({pseudo: event.target.value});
        this.checkPseudo(event.target.value);
    }

    handleChangePassword(event) {
        this.setState({password: event.target.value});
        this.checkPassword(event.target.value);
    }

    handleChangePasswordConfirmation(event) {
        if(this.state.password == event.target.value)
            this.setState({passwordConf:true})
        else
            this.setState({passwordConf:false})
    }

    checkPassword(password) {
        setTimeout(() => {
            let resultat = /^(?=.{3,128}$)(?!.*[_.]{2})[a-zA-Z0-9._]/.test(password);
            this.setState({
                isPasswordGood:resultat
            })
        },800)
    }

    checkPseudo(pseudo) {
        setTimeout(() => {
            let resultat = /^(?=.{3,20}$)(?!.*[_.]{2})[a-zA-Z0-9._]/.test(pseudo);
            this.setState({
                isPseudoGood:resultat
            })
        },800)
    }

    handleSubmit(e) {
        e.preventDefault();
        if(this.state.isPasswordGood == true && this.state.isPseudoGood == true && this.state.passwordConf) {
            fetch(utils.getFetchUrl()+"/u/signup/1",
                  {
                      method: "post",
                      body: new FormData(this.refs.form),
                  })

                .then((res) => {
                    return res.text();
                })

                // .then((data) => { browserHistory.push('/') })
        }
    }

    render() {
        let passwordClass = "", pseudoClass = ""
        if(this.state.isPasswordGood==false)
            passwordClass="error";
        if(this.state.isPseudoGood == false)
            pseudoClass="error";
        return (
            <div className="postcreator center">
                <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                    <div className="form__header">Si vous n'êtes pas inscrit, c'est le moment de le faire !</div>
                    <div className="form__input">
                        <label htmlFor="mail">Mail
                            <input type="text" required={true} name="mail" id="mail" placeholder="Insérez votre mail"
                                   onChange={this.handleChangeMail.bind(this)}/>
                        </label>
                    </div>
                    <div className="form__input">
                        <label htmlFor="username">Pseudo
                            <input className={pseudoClass} type="text" required={true} name="username" id="username" placeholder="Votre pseudo (8 à 20 caractères)"
                                   onChange={this.handleChangePseudo.bind(this)}/>
                        </label>
                    </div>
                    <div className="form__input">
                        <label htmlFor="password">Mot de passe
                            <input className={passwordClass} type="password" required={true} name="password" id="password" placeholder="Mot de passe"
                                   onChange={this.handleChangePassword.bind(this)}/>
                        </label>
                    </div>
                    <div className="form__input">
                        <label htmlFor="passwordconfirmation">Confirmation du mot de passe
                            <input ref="passconfirm" className={passwordClass} type="password" required={true} name="passwordconfirmation" id="passconfirm" placeholder="Mot de passe"
                            onChange={this.handleChangePasswordConfirmation.bind(this)}/>
                        </label>
                    </div>
                    <input type="submit" value="Créer votre compte"/>
                </form>
            </div>
        )
    }

}


/* Regex : username : /.{3,20}/
   ^(?=.{3,20}$)(?!.*[_.]{2})[a-zA-Z0-9._]
   password : /.{6,}/  */
