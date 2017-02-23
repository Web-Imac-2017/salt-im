import React from 'react'
import './PostCreatorView.scss'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export const PostCreatorView = () => (
  <div className="postcreator center">
    <form className="form">
        <InputText title="Titre du post" idInput="title" placeholder="Un truc bien salé, tmtc"/>
        <InputTextarea title="Description du post" idInput="description" placeholder="Décris tes propos"/>
        <InputText title="Tags" idInput="tags" placeholder="Des tags séparés par des virgules"/>
        <div className="form__input form__input--side flex">
            <div className="form__title flex-4">icône du post</div>
            <input type="file" className="flex-6"/>
        </div>
        <input type="submit" value="Ajouter un post"/>
    </form>

  </div>
)

export default PostCreatorView
