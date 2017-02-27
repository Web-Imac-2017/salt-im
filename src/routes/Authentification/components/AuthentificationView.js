import React from 'react'
import {Link} from 'react-router'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export const AuthentificationView = () => (
  <div className="postcreator center">
    <Link to="/posts" className="goback">Retour aux posts</Link>
    <form className="form">
        <div className="form__header">Connexion</div>
        <InputText title="Nom d'utilisateur" idInput="title" placeholder="Nom d'utilisateur"/>
        <InputText title="Mot de passe" idInput="tags" placeholder="Des tags séparés par des virgules"/>
        <input type="submit" value="Connexion"/>
    </form>

  </div>
)

export default AuthentificationView
