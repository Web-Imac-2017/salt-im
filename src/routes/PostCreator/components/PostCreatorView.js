import React, {Component} from 'react'
import {Link} from 'react-router'
import './PostCreatorView.scss'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export default  class PostCreatorView extends Component {
    constructor(props) {
      super(props);

      this.state = {
        title:"",
        description:"",
        tags:"",
      };
    }

    render() {
        let self  =this;
        console.log(this.state.title)
        return (
            <div className="postcreator center">
              <Link to="/posts" className="goback">Retour aux posts</Link>
              <form className="form">
                  <div className="form__header">Nouveau post</div>
                  <div className="form__input">
                      <label for="title">Titre</label>
                      <input type="text" name="title" id="title" placeholder="Un true bien salé"
                        onChange={
                            (text)=> {
                                self.setState({title:text})
                                console.log(text)
                            }
                        }/>
                  </div>
                  <InputTextarea title="Description du post" idInput="description" placeholder="Décris tes propos"/>
                  <InputText title="Tags" idInput="tags" placeholder="Des tags séparés par des virgules"/>
                  <div className="form__input form__input--side flex">
                      <div className="form__title">image du post</div>
                      <input type="file"/>
                  </div>
                  <input type="submit" value="Ajouter un post"/>
              </form>
            </div>
        )
    }
}
