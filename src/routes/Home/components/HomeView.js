import React from 'react'
import DuckImage from '../assets/Duck.jpg'
import './HomeView.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import SearchBar from '../../../components/SearchBar/SearchBar.js'

var dataListPost = [
    {
        "id":0,
        "type":"link",
        "url":"http://internetactu.blog.lemonde.fr/2017/02/19/apres-lintelligence-artificielle-lintelligence-etendue/",
        "title":"Super title putaclic",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":19,
        "pepper":20,
        "tags":["boisson","mere","buzz"]
    },
    {
        "id":1,
        "type":"image",
        "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
        "title":"Super title putaclic sa mère",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":18,
        "pepper":20,
        "tags":["boisson","mere"]
    }
]

export const HomeView = () => (
  
  <div className="home">
    <h1 className="home__title">Salty</h1>

    <SearchBar/>

    <ListPost title="Posts tendances" data={dataListPost}/>
  </div>
)

export default HomeView