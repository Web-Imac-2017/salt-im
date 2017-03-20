import React, {Component} from 'react'
import { IndexLink, Link } from 'react-router'
import './PreviewShare.scss'
import { FacebookButton, TwitterButton, EmailButton } from "react-social";

export default class PreviewShare extends Component {

    toggleClose() {
        this.props.closeShare();
    }

    copyText() {
          this.refs.input.select();

          try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
          } catch (err) {
          }
    }

    render() {
        let classes = "previewshare ";
        if(this.props.isActive)
            classes += "previewshare--active";
        let url = "http://localhost:3000/post/"
        if(this.props.data)
            url = "http://localhost:3000/post/"+this.props.data.id;
        return(
            <div className={classes}>
                <div className="previewshare__filter" onClick={this.toggleClose.bind(this)}/>
                <img src="/close.svg" className="bigger__close" onClick={this.toggleClose.bind(this)}/>
                <div className="previewshare__wrapper">
                    <div className="previewshare__title">Partager cet article sur :</div>

                    <div className="previewshare__buttons">
                        <FacebookButton url={url} appId={1595976023764540}>
                            {"Facebook"}
                        </FacebookButton>
                        <TwitterButton url={url}>
                            {"Twitter"}
                        </TwitterButton>
                        <EmailButton url={url}>
                            {"Mail"}
                        </EmailButton>
                    </div>

                    <div className="previewshare__copy">
                        <input className="previewshare__input" type="text" value={url} ref="input"/>
                        <div className="previewshare__copybutton" onClick={this.copyText.bind(this)}>copier</div>
                    </div>

                </div>
            </div>
        )
    }
}

