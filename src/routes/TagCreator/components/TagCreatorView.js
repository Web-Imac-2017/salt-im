import React, {Component} from 'react'
import {Link} from 'react-router'
import './TagCreatorView.scss'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

export default class TagCreatorView extends Component{
    constructor(props){
        super(props);

        this.state = {
            title : "",
            description: "",
            picUrl:"",
            link:"",
        };
    }


    handleChangeTitle(event){
        this.setState({title: event.target.value});
    }

    handleChangeDescription(event){
        this.setState({description: event.target.value});
    }

    handleChangePicUrl(event){
        this.setState({picUrl: event.target.value});
    }

    handleChangeLink(event){
        this.setState({link: event.target.value});
    }


    handleSubmit(event) {
        event.preventDefault();
        let self = this;

        console.log(this.refs.file);

        fetch("http://localhost:8888/salt-im/api/tag/add/",
        {
            method: "post",
            body: new FormData(self.refs.form),
        })
        .then((res) => {
            console.log(res)
            return res.text();
        }).then((data) => {console.log(data)})
    }

    render() {
        let self  =this;

        let d = new Date();
        let iso_date_string = d.toISOString();
        // produces "2014-12-15T19:42:27.100Z"
        let locale_date_string = d.toLocaleDateString();

        if(!this.props.dataUser)
          return(<Redirection/>)

        return (
            <div className="creator tagcreator center">
                <Link to="/tags" className="goback">Retour aux tags</Link>
                <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                    <div className="form__header">Lancez-vous dans le graffiti !</div>
                        <div className="form__input">
                            <label for="name">Titre
                                <input
                                type="text" name="name" id="name" placeholder="#hashtag"
                                onChange={this.handleChangeTitle.bind(this)}
                                required="required"/>
                            </label>
                        </div>

                        <div className="form__input">
                            <label for="description">Description
                                <input
                                type="text" name="description" id="description" placeholder="De quoi tu causes?"
                                onChange={this.handleChangeTitle.bind(this)}
                                required="required"/>
                            </label>
                        </div>


                    <div className="form__input form__input--side flex">
                    <div className="form__title">Image du tag</div>
                    <input type="file" name="userfile" ref="file"/>
                    </div>
                  <input type="hidden" value={locale_date_string} name="date" />
                  <input type="submit" value="Ajouter un tag"/>
                </form>
            </div>
            )
    }
}

