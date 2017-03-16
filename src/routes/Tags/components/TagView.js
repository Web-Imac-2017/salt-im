import React, { Component } from 'react'
import { Link } from 'react-router';
import './TagView.scss'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'
import ListTagLine from '../../../components/ListTag/line/ListTagLine.js'
import TagData from './TagData/TagData.js'
import utils from '../../../../public/utils.js'

export default class TagView extends Component {
    constructor(props) {
        super(props);

        this.state = {
            tagdata:{},
            line: true
        };
    }

    componentDidMount() {

        const myInit = {method: 'POST'};

        fetch(utils.getFetchUrl()+"/tag/all", myInit)
            .then((response) => response.json())
            .then((object) => { this.setState({tagdata: object})})
    }

    render() {

        return (
            <div className="tagview">
                <div className="tagview__titles">
                    <p className="tagview__titles__titleTrends">Tags tendances</p>
                    <Link to="/tag/create">
                        <button className="tagview__titles__addTrends">+ Ajouter un tag</button>
                    </Link>
                </div>

                <ListTagColumn data={this.state.tagdata } size={10} />

                <p className="tagview__titleAll">Retrouvez tous les tags</p>

                <ListTagLine data={this.state.tagdata} line={this.state.line}/>

            </div>
        );
    }
}
