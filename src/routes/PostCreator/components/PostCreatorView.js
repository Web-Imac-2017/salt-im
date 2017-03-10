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

    handleChangeTitle(event) {
        this.setState({title: event.target.value});
    }

    handleChangeDescription(event) {
        this.setState({description: event.target.value});
    }

    handleChangeTags(event) {
        this.setState({description: event.target.value});
    }

    handleSubmit(event) {
        event.preventDefault();
        let self = this;

        fetch("http://localhost:8888/salt-im/api/p/post/add/90",
        {
            method: "post",
            body: new FormData(self.refs.form),
        })
        .then((res) => {
            console.log(res)
            return res;
        }).then((data) => {console.log(data)})
    }

    render() {
        let self  =this;

        let d = new Date();
        let iso_date_string = d.toISOString();
        // produces "2014-12-15T19:42:27.100Z"
        let locale_date_string = d.toLocaleDateString();

        return (
            <div className="postcreator center">
              <Link to="/posts" className="goback">Retour aux posts</Link>
              <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                  <div className="form__header">Nouveau post</div>
                  <div className="form__input">
                    <label for="title">Titre
                        <input
                            type="text" name="title" id="title" placeholder="Un true bien salé"
                            onChange={this.handleChangeTitle.bind(this)}
                            required="required"
                        />
                    </label>
                  </div>
                  <div className="form__input">
                    <label for="text">Description du post
                        <input
                            type="text" name="text" id="text" placeholder="Décris tes propos"
                            onChange={this.handleChangeDescription.bind(this)}
                            required="required"
                        />
                    </label>
                  </div>
                  <div className="form__input">
                    <label for="tags">Tags
                        <input
                            type="text" name="tags" id="tags" placeholder="Des tags séparés par des virgules"
                            onChange={this.handleChangeTags.bind(this)}
                            required="required"
                        />
                    </label>
                  </div>
                  <div className="form__input form__input--side flex">
                      <div className="form__title">image du post</div>
                      <input type="file"/>
                  </div>
                  <input type="hidden" value={locale_date_string} name="date" />
                  <input type="hidden" value={57} name="user_id" />
                  <input type="submit" value="Ajouter un post"/>
              </form>
            </div>
        )
    }
}
