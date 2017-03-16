import React, {Component} from 'react'
import './HomeView.scss'
import '../../Tags/components/TagView.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import SearchBar from '../../../components/SearchBar/SearchBar.js'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'
import Filter from '../../../components/Filter/Filter.js'
import utils from '../../../../public/utils.js'


export default class HomeView extends Component {
    constructor(props) {
        super(props);

        this.state = {
            dataListPost:{},
            dataListTags:{}
        };
    }

    componentDidMount() {
        fetch(utils.getFetchUrl()+"/tag/all")
            .then((tagResponse) => tagResponse.json())
            .then((tagData) => {this.setState({dataListTags : tagData})})

        fetch("http://www.json-generator.com/api/json/get/bSmxnPKrma?indent=2")
            .then((response) => response.json())
            .then((data) =>{this.setState({dataListPost : data})})
    }

    render() {
        return(
            <div className="home center">
                <p className="home__title">Tags tendances</p>
                <ListTagColumn data={this.state.dataListTags} size={5}/>
                <div className="tagview__section">
                    <div className="home__titles">
                        <p className="home__title">Les salés du jour</p>
                        <Filter/>
                    </div>
                    <ListPost data={this.state.dataListPost} dataUser={this.props.dataUser}/>
                </div>
            </div>
        )
    }
}
//<SearchBar/>