import React from 'react'
import './PostView.scss'
import PostData from './PostData/PostData.js'

let dataPost = {
    "id":1,
    "type":"image",
    "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
    "title":"Super title putaclic sa mère",
    "description":"Sa darrone ils boivent du sprite sa mère",
    "salt":18,
    "pepper":20,
    "tags":["boisson","mere"]
}

dataPost = {
    "id":1,
    "type":"video",
    "url":"https://www.youtube.com/watch?v=_dux_Ugs2lk",
    "title":"Super title putaclic sa mère",
    "description":"Sa darrone ils boivent du sprite sa mère",
    "salt":18,
    "pepper":20,
    "tags":["boisson","mere"]
}

export const PostView = () => (

  <div className="post">
    <PostData data={dataPost}/>
  </div>
)

export default PostView
