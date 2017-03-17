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
            dataListTags:{},
            idStat: 1
        };
    }

    componentDidMount() {
        fetch(utils.getFetchUrl()+"/tag/all")
            .then((tagResponse) => tagResponse.json())
            .then((tagData) => {this.setState({dataListTags : tagData})})

        fetch(utils.getFetchUrl()+"/p/all/stat/"+this.state.idStat)
            .then((response) => response.json())
            .then((data) =>{
                console.log(data);
                this.setState({dataListPost : data})
            })
    }

    handleStatSelect = (e) => {
        console.log(e)
        this.setState({idStat: e})
        let urlToFetch = "/p/all/stat/"+this.state.idStat;
        if(e==4)
            urlToFetch = "/p/all/date/"+this.state.idStat
        fetch(utils.getFetchUrl()+urlToFetch)
               .then((response) => response.json())
               .then((data) =>{
                console.log(data)
                this.setState({dataListPost : data})
            })
    }

    render() {
        return(
            <div className="home">
                <p className="home__title">Tags tendances</p>
                <ListTagColumn data={this.state.dataListTags} size={5}/>
                <div className="tagview__section">
                    <div className="home__titles">
                        <p className="home__title">Les salés du jour</p>
                        <Filter onChange={this.handleStatSelect} />
                    </div>
                    <ListPost data={this.state.dataListPost} dataUser={this.props.dataUser}/>
                </div>
            </div>
        )
    }
}
//<SearchBar/>
