import React, {Component} from 'react'
import {Link} from 'react-router'
import './PostCreatorView.scss'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

import utils from "../../../../public/utils.js";

export default  class PostCreatorView extends Component {
    constructor(props) {
      super(props);

      this.state = {
        title:"",
        description:"",
        tags:"",
        isSuccess:false,
        isSubmitDisabled:false,
        link:"",
        type:"",
      };
    }

    handleChangeLink(event) {
      this.setState({link:event.target.value});
      let type = utils.getTypeData(event.target.value);
      if(!type)
        this.setState({type:"link"})
      else
        this.setState({type:type})
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

        this.setState({
          isSubmitDisabled:true,
        })

        fetch("http://localhost/salt-im/api/p/post/add/90",
        {
            method: "post",
            body: new FormData(self.refs.form),
        })
        .then((res) => {
            return res.text();
        }).then((data) => {
          let datap = "success";
          if(datap == "success")
            this.launchSuccessCreation();
        })
    }



    launchSuccessCreation() {
      this.setState({
        isSuccess:true,
      })
    }

    render() {
        let self  =this;

        let d = new Date();
        let iso_date_string = d.toISOString();
        // produces "2014-12-15T19:42:27.100Z"
        let locale_date_string = d.toLocaleDateString();

        let classSuccess = "success";
        if(this.state.isSuccess)
          classSuccess += " success--active";

        return (
            <div className="postcreator center">
              <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                  <div className="form__header">Nouveau post</div>
                  <div className="form__input">
                    <label for="title">Titre
                        <input
                            type="text" name="title" id="title" placeholder="Un truc bien salé"
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

                  <div className="form__input">
                    <label for="tags">Link
                        <input
                            type="text" name="link" id="link" placeholder="url"
                            onChange={this.handleChangeLink.bind(this)}
                        />
                    </label>
                  </div>

                  <div className="form__input form__input--side flex">
                      <div className="form__title">image du post</div>
                      <input type="file"/>
                  </div>

                  <input type="hidden" value={locale_date_string} name="date" />
                  <input type="hidden" value={3} name="user_id"/>
                  <input type="hidden" value="post" name="type"/>
                  <input type="hidden" value={this.state.type} name="type"/>
                  <input type="submit" value="Ajouter un post" disabled={this.state.isSubmitDisabled}/>
                  <div className={classSuccess}>Le post a bien été créé</div>
              </form>
            </div>
        )
    }
}
