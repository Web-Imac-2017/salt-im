import React, {Component} from 'react'
import {Link} from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'
import utils from '../../../../public/utils.js'

export default class SignIn extends Component {
    constructor(props) {
        super(props);

        this.state = {
            pseudo:"",
            password:"",
            nbFail:0,
        };
    }

    handleChangePseudo(event) {
        this.setState({pseudo: event.target.value});
    }

    handleChangePassword(event) {
        this.setState({password: event.target.value});
    }

    handleSubmit(event) {
        event.preventDefault();

        fetch(utils.getFetchUrl()+"/u/login/1",
              {
                  method: "post",
                  body: new FormData(this.refs.form),
                  mode: "no-cors",
                  credentials:"include"
              })

            .then(() => this.checkSession())

        /* fetch(utils.getFetchUrl()+"/u/start/10")
         *     .then(() => this.launchLogin())*/
    }

    launchLogin(){

        fetch(utils.getFetchUrl()+"/u/login/1",
              {
                  method: "post",
                  body: new FormData(this.refs.form),
                  mode: "no-cors",
                  credentials:"include"
              })

            .then(() => this.checkSession())
    }

    checkSession(){

        fetch(utils.getFetchUrl()+"/u/session/5", {
            method: "post",
            mode: "no-cors",
            credientials: "include"
        })
            .then((data) => data.text() )
            .then((response) => {
                console.log("response session " + response);
                this.handleErrors(response);
            })
    }

    handleErrors(data){
        if(data.includes("n'est pas connecté"))
            this.setState({nbFail:this.state.nbFail+1})
    }

    render() {
        let classModal="modal "
        if(this.state.nbFail>=5) {
            classModal+="modal--active";
        }
        return (
            <div>
                <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                    <div className="form__header">Connexion</div>
                    <div className="form__input">
                        <label htmlFor="pseudo">Pseudo
                            <input type="text" required={true} name="username" id="pseudo" placeholder="Votre pseudo (8 à 20 caractères)"
                                   onChange={(event)=>{this.handleChangePseudo.bind(this)}}/>
                        </label>
                    </div>
                    <div className="form__input">
                        <label htmlFor="password">Mot de passe
                            <input type="password" required={true} name="password" id="password" placeholder="Mot de passe"
                                   onChange={this.handleChangePassword.bind(this)}/>
                        </label>
                    </div>
                    <input type="submit" value="Connexion"/>
                </form>
                <div className={classModal}>
                    <div className="modal__filter"/>
                    <div className="modal__wrapper">
                        <div className="error-text">Tu t'es trompé 5 fois pour te connecter, tu es une déception</div>
                        <img className="stop" src="/feroce.gif"/>
                    </div>
                </div>
            </div>
        )
    }

}


/* Regex : username : /.{3,20}/
   ^(?=.{3,20}$)(?!.*[_.]{2})[a-zA-Z0-9._]
   password : /.{6,}/  */
