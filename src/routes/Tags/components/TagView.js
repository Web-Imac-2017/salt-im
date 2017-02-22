import React from 'react'
import './TagView.scss'
import ListTagColumn from '../../../components/ListTag/column/ListTagColumn.js'

let dataTags = [
  {
    "title":"Nasa",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  },
  {
    "title":"Harsh Noise",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
  }
]

export const TagView = () => (

  <div className="tagview">
    <ListTagColumn data={dataTags}/>
  </div>
)

export default TagView
