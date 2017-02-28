import React from 'react'
import './HomeView.scss'
import '../../Tags/components/TagView.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import SearchBar from '../../../components/SearchBar/SearchBar.js'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'

const dataListPost = [
    {
        "id":0,
        "type":"link",
        "url":"http://internetactu.blog.lemonde.fr/2017/02/19/apres-lintelligence-artificielle-lintelligence-etendue/",
        "title":"Super title putaclic",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":19,
        "pepper":20,
        "tags":["boisson","mere","buzz"],
        "date":"12 jan. 2017",
        "author":"Thomas Lerouô"
    },
    {
        "id":1,
        "type":"image",
        "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
        "title":"Super title putaclic sa mère",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":18,
        "pepper":20,
        "tags":["boisson","mere"],
        "date":"12 jan. 2017",
        "author":"Thomas Lerouô"
    }
]

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

export const HomeView = () => (

  <div className="home center">
    <h1 className="home__title">Salty</h1>

    <SearchBar/>

    <p className="tagview__titleTrends">Tags tendances</p>

    <ListTagColumn data={dataTags}/>

    <p className="tagview__titleTrends">Posts les plus salés</p>

    <ListPost data={dataListPost}/>
  </div>
)

export default HomeView
