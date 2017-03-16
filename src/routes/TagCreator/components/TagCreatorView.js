import React, {Component} from 'react'
import {Link} from 'react-router'
import './TagCreatorView.scss'

import InputText from '../../../components/InputText/InputText.js'
import InputTextarea from '../../../components/InputTextarea/InputTextarea.js'

import utils from '../../../../public/utils.js'
import Redirection from '../../../components/Redirection/Redirection.js'

export default class TagCreatorView extends Component{
    constructor(props){
        super(props);

        this.state = {
            title : "",
            description: "",
            picUrl:"",
            link:"",
            isSuccess:false
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

        console.log(this.refs.file);

        fetch(utils.getFetchUrl()+"/tag/add/",
              {
                  method: "post",
                  body: new FormData(this.refs.form),
              })
            .then((res) => {
                console.log(res)
                return res.text();
            })
            .then((data) => {
                let datap = "success";
                if(datap == "success"){
                    this.launchSuccessCreation();
                }
            })
    }

    launchSuccessCreation() {
        this.setState({
            isSuccess:true,
        })
    }

    render() {

        let d = new Date();
        let iso_date_string = d.toISOString();
        // produces "2014-12-15T19:42:27.100Z"
        let locale_date_string = d.toLocaleDateString();

        let classSuccess = "success";
        if(this.state.isSuccess)
            classSuccess += " success--active";

        if(!this.props.dataUser)
            return(<Redirection/>)

        return (
            <div className="creator tagcreator center">
                <Link to="/tags" className="goback">Retour aux tags</Link>
                <form className="form" onSubmit={this.handleSubmit.bind(this)} ref="form">
                    <div className="form__header">Lancez votre propre tag !</div>
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


                    <input type="hidden" value={locale_date_string} name="date" />
                    <input type="submit" value="Ajouter un tag"/>
                </form>

                <div className={classSuccess}>Le tag a bien été créé</div>
            </div>
        )
    }
}
