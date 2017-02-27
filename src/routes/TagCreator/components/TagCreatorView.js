import React from 'react'
import {Link} from 'react-router'
import './TagCreatorView.scss'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export const TagCreatorView = () => (
  <div className="creator tagcreator center">
    <Link to="/tags" className="goback">Retour aux tags</Link>
    <form className="form">
        <div className="form__header">Lancez-vous dans le graffiti !</div>
        <InputText title="Titre du tag" idInput="title" placeholder="Info, politique, harsh noise etc."/>
        <InputTextarea title="Description du tag" idInput=" " placeholder="C’est pour qu’on sache de quoi ça parle"/>
        <div className="form__input form__input--side flex">
            <div className="form__title">icône du tag</div>
            <input type="file"/>
        </div>
        <input type="submit" value="Ajouter un tag"/>
    </form>

  </div>
)

export default TagCreatorView
