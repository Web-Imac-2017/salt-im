import React, {Component} from 'react'
import {Link} from 'react-router'

import InputTextModal from '../../../components/InputTextModal/InputTextModal.js'
import InputTextareaModal from '../../../components/InputTextareaModal/InputTextareaModal.js'

import utils from '../../../../public/utils.js'

export default class ProfileUpdateView extends Component{
    
    handleSubmit(event) {
        event.preventDefault();

        fetch(utils.getFetchUrl()+"u/update/"+ this.props.idUser,
              {
                  method: "post",
                  body: new FormData(this.refs.form),
              })
            .then((res) => {
                return res.text();
            }).then((data) => {
                let datap = "success";
                if(datap == "success"){
                    this.launchSuccessCreation();
                }
            })
    }

    render(){
        return(
            <div className="postcreator center">

                <form enctype="multipart/form-data" onSubmit={this.handleSubmit.bind(this)} ref="form" className="form">
                    <div className="form__header">Mise à jour des informations de votre profil</div>
                    <InputTextModal title="Nouveau nom d'utilisateur" idInput="title" placeholder="Nom d'utilisateur"/>
                    <h1 className="form__header"> Nouvel avatar </h1>
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />

                    <div className="form__input form__input--side flex">
                        <div className="form__title">image du post</div>
                        <input type="file" name="userfile"/>
                    </div>

                    <InputTextModal title="Nouvel e-mail" idInput="mail" placeholder="votrenom@monfai.net"/>
                    <InputTextModal title="Ancien mot de passe" idInput="tags" placeholder=""/>
                    <InputTextModal title="Nouveau mot de passe" idInput="tags" placeholder=""/>
                    <input type="submit" value="Mettre à jour"/>
                </form>
            </div>
        )
    }
}

