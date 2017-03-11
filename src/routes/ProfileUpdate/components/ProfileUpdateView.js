import React from 'react'
import {Link} from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export const ProfileUpdateView = () => (
  <div className="postcreator center">
    <Link to="/posts" className="goback">Retour au profil</Link>
    <form className="form">
        <div className="form__header">Mise à jour des informations de votre profil</div>
        <InputText title="Nouveau nom d'utilisateur" idInput="title" placeholder="Nom d'utilisateur"/>
        <h1> Nouvel avatar </h1>
        <div className="form__input form__input--side flex">
            <input type="file"/>
        </div>
        <InputText title="Nouvel e-mail" idInput="mail" placeholder="votrenom@monfai.net"/>
        <InputText title="Ancien mot de passe" idInput="tags" placeholder=""/>
        <InputText title="Nouveau mot de passe" idInput="tags" placeholder=""/>
        <input type="submit" value="Mettre à jour"/>

    </form>

  </div>
)

export default ProfileUpdateView
