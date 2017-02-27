import React from 'react'
import './TagView.scss'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'
import ListTagLine from '../../../components/ListTag/line/ListTagLine.js'

const dataTags = [
  {
    "title":"Nasa",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"https://www.residentadvisor.net/images/features/2015/merzbow-conversation-light.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Daft punk",
    "picUrl":"http://pitchfork.com/features/cover-story/reader/daft-punk/images/s9-0v2.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"South Park",
    "picUrl":"http://www.ecranlarge.com/uploads/image/000/945/south-park-caitlin-jenner-945289.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Esipe vs Imac",
    "picUrl":"https://upload.wikimedia.org/wikipedia/fr/4/43/Universit%C3%A9_de_Marne-la-Vall%C3%A9e,_B%C3%A2timent_Copernic,_Champs-sur-Marne,_France.jpg",
    "link":"/tags/nasa"
  },
    {
    "title":"Nasa",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"https://www.residentadvisor.net/images/features/2015/merzbow-conversation-light.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Daft punk",
    "picUrl":"http://pitchfork.com/features/cover-story/reader/daft-punk/images/s9-0v2.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"South Park",
    "picUrl":"http://www.ecranlarge.com/uploads/image/000/945/south-park-caitlin-jenner-945289.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Esipe vs Imac",
    "picUrl":"https://upload.wikimedia.org/wikipedia/fr/4/43/Universit%C3%A9_de_Marne-la-Vall%C3%A9e,_B%C3%A2timent_Copernic,_Champs-sur-Marne,_France.jpg",
    "link":"/tags/nasa"
  }
]

const size = "small";

export const TagView = () => (

  <div className="tagview">
    <p className="tagview__titleTrends">Tags tendances</p>
    <ListTagColumn data={dataTags}/>
    <p className="tagview__titleAll">Retrouvez tous les tags</p>
    <ListTagLine data={dataTags} size={size}/>
  </div>
)

export default TagView
