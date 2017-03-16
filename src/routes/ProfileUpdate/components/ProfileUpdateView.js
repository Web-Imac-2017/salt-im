import React from 'react'
import {Link} from 'react-router'

import InputTextModal from '../../../components/InputTextModal/InputTextModal.js'
import InputTextareaModal from '../../../components/InputTextareaModal/InputTextareaModal.js'

export const ProfileUpdateView = () => (
  <div className="postcreator center">
    
    <form className="form">
        <div className="form__header">Mise à jour des informations de votre profil</div>
        <InputTextModal title="Nouveau nom d'utilisateur" idInput="title" placeholder="Nom d'utilisateur"/>
        <h1 className="form__header"> Nouvel avatar </h1>
        <div className="form__input form__input--side flex">
            <input type="file"/>
        </div>
        <InputTextModal title="Nouvel e-mail" idInput="mail" placeholder="votrenom@monfai.net"/>
        <InputTextModal title="Ancien mot de passe" idInput="tags" placeholder=""/>
        <InputTextModal title="Nouveau mot de passe" idInput="tags" placeholder=""/>
        <input type="submit" value="Mettre à jour"/>
    </form>

  </div>
)

export default ProfileUpdateView
