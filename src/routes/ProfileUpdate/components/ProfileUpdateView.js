import React from 'react'
import {Link} from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export const ProfileUpdateView = () => (
  <div className="postcreator center">
    <Link to="/posts" className="goback">Retour aux posts</Link>
    <form className="form">
        <div className="form__header">Inscription</div>
        <InputText title="Nom d'utilisateur" idInput="title" placeholder="Nom d'utilisateur"/>
        <InputText title="E-Mail" idInput="mail" placeholder="votrenom@monfai.net"/>
        <InputText title="Mot de passe" idInput="tags" placeholder="Des tags séparés par des virgules"/>
        <input type="submit" value="Inscription"/>
    </form>

  </div>
)

export default ProfileUpdateView
