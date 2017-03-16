import React, {Component} from 'react'
import Tags from '../../../../../components/ListPost/PostPreview/Tags/Tags.js'
import "./MainData.scss";
import PreviewActions from '../../../../../components/ListPost/PostPreview/PreviewActions/PreviewActions.js'
import utils from '../../../../../../public/utils.js'

export default class MainData extends Component {
    constructor(props) {
      super(props);

      this.state = {
        tags:""
      };
    }

    componentDidMount() {
        fetch(utils.getFetchUrl() + "/tag/p/"+this.props.data.id)
            .then((data) => data.text())
            .then((object) => {
                console.log(object);
            })
    }

    render() {
        let dataLink = (<div/>);
        if(this.props.data) {
            if(this.props.data.type == "link")
                dataLink = (<a target="_blank" href={this.props.data.url} className="data__link">Voir le lien</a>)
        } else {
            return (<div/>)
        }

        return(
            <div className="data">
                <div className="data__author">{this.props.data.date} par {this.props.dataUser}</div>
                <div className="data__title">{this.props.data.title}</div>
                <div className="data__description">{this.props.data.text}</div>
                {dataLink}
                <PreviewActions data={this.props.data} nbComment={this.props.nbComment} dataUser={this.props.user}/>
            </div>
        )
    }
}
