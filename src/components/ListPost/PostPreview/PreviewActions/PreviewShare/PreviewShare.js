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
            console.log('Oops, unable to copy');
          }
    }

    render() {
        let classes = "previewshare ";
        if(this.props.isActive)
            classes += "previewshare--active";

        let url = "https://wwww.google.com";
        return(
            <div className={classes}>
                <div className="previewshare__filter" onClick={this.toggleClose.bind(this)}/>
                <div className="previewshare__wrapper">
                    <div className="previewshare__close" onClick={this.toggleClose.bind(this)}>close</div>
                    <div className="previewshare__title">Partager cette article sur :</div>

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

