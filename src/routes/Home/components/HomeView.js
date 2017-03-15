import React, {Component} from 'react'
import './HomeView.scss'
import '../../Tags/components/TagView.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import SearchBar from '../../../components/SearchBar/SearchBar.js'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'
import Filter from '../../../components/Filter/Filter.js'

const dataTags = [
  {
    "title":"Nasa",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tag/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"https://www.residentadvisor.net/images/features/2015/merzbow-conversation-light.jpg",
    "link":"/tag/nasa"
  },
  {
    "title":"Daft punk",
    "picUrl":"http://pitchfork.com/features/cover-story/reader/daft-punk/images/s9-0v2.jpg",
    "link":"/tag/nasa"
  },
  {
    "title":"South Park",
    "picUrl":"http://www.ecranlarge.com/uploads/image/000/945/south-park-caitlin-jenner-945289.jpg",
    "link":"/tag/nasa"
  },
  {
    "title":"Esipe vs Imac",
    "picUrl":"https://upload.wikimedia.org/wikipedia/fr/4/43/Universit%C3%A9_de_Marne-la-Vall%C3%A9e,_B%C3%A2timent_Copernic,_Champs-sur-Marne,_France.jpg",
    "link":"/tag/nasa"
  }
]

export default class HomeView extends Component {
  constructor(props) {
    super(props);

    this.state = {
      dataListPost:{},
    };
  }

  componentDidMount() {
    fetch("http://www.json-generator.com/api/json/get/bSmxnPKrma?indent=2")
      .then((response) => response.json())
      .then((data) =>{this.setState({dataListPost:data})})
  }

  render() {
    return(
      <div className="home center">
        <SearchBar/>
        <p className="tagview__titleTrends">Tags tendances</p>
        <ListTagColumn data={dataTags}/>
        <div className="tagview__section">
          <div className="home__titles">
            <p className="tagview__titleTrends">Les salés du jour</p>
            <Filter/>
          </div>
          <ListPost data={this.state.dataListPost} dataUser={this.props.dataUser}/>
        </div>
      </div>
    )
  }
}
