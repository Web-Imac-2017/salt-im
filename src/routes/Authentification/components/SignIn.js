import React, {Component} from 'react'
import {Link} from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

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
      fetch("http://localhost:8888/salt-im/api/u/login",
        {
            method: "post",
            body: new FormData(this.refs.form),
        })
        .then((res) => {
            return res.text();
        }).then((data) => {
          console.log(data);
        })
      // this.setState({
      //     nbFail:this.state.nbFail+1
      // })
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
                <label for="pseudo">Pseudo
                  <input type="text" required={true} name="username" id="pseudo" placeholder="Votre pseudo (8 à 20 caractères)"
                    onChange={(event)=>{this.handleChangePseudo.bind(this)}}/>
                </label>
            </div>
            <div className="form__input">
                <label for="password">Mot de passe
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
