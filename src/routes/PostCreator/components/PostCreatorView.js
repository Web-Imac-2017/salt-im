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
        let payload = {
            "title":this.state.title,
            "text":this.state.description,
            "date":Date.now()
        }
        let data = new FormData();
        data.append( "json", JSON.stringify( payload ) );

        fetch("http://localhost:8888/salt-im/api/p/post/add/1",
        {
            method: "POST",
            body: data
        })
        .then(function(res){ console.log(res); return res.json(); })
        .then(function(data){ console.log(data); alert( JSON.stringify( data ) ) })
    }

    render() {
        let self  =this;
        console.log(this.state.title)
        return (
            <div className="postcreator center">
              <Link to="/posts" className="goback">Retour aux posts</Link>
              <form className="form" onSubmit={this.handleSubmit.bind(this)}>
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
                    <label for="description">Description du post
                        <input
                            type="text" name="description" id="description" placeholder="Décris tes propos"
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
                  <input type="submit" value="Ajouter un post"/>
              </form>
            </div>
        )
    }
}
