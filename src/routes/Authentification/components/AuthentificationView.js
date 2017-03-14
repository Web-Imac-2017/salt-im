import React, {Component} from 'react'
import {Link} from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export default class AuthentificationView extends Component {
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
        this.setState({
            nbFail:this.state.nbFail+1
        })
    }

    render() {
        let classModal="modal "
        if(this.state.nbFail>=5) {
            classModal+="modal--active";
        }
        return(
            <div className="postcreator center">
              <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                  <div className="form__header">Inscription</div>
                  <div className="form__input">
                      <label for="pseudo">Pseudo
                        <input type="text" required={true} name="pseudo" id="pseudo" placeholder="Votre pseudo (8 à 20 caractères)"
                          onChange={(event)=>{this.handleChangePseudo.bind(this)}}/>
                      </label>
                  </div>
                  <div className="form__input">
                      <label for="email">Email
                        <input type="text" required={true} name="pseudo" id="email" placeholder="Votre email"
                          onChange={(event)=>{this.handleChangePseudo.bind(this)}}/>
                      </label>
                  </div>

                  <div className="form__input">
                      <label for="password">Mot de passe
                      <input type="password" required={true} name="password" id="password" placeholder="Votre mot de passe"
                        onChange={this.handleChangePassword.bind(this)}/>
                      </label>
                  </div>
                  <div className="form__input">
                      <label for="password">Confirmation de votre mot de passe
                      <input type="password" required={true} name="password" id="password" placeholder="Votre mot de passe"
                        onChange={this.handleChangePassword.bind(this)}/>
                      </label>
                  </div>
                  <input type="submit" value="Créer votre compte"/>
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
