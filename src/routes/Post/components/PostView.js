import React from 'react'
import './PostView.scss'
import '../../Tags/components/TagView.scss'
import PostData from './PostData/PostData.js'
import ListComment from '../../../components/ListComment/ListComment.js'

import type { PostObject } from '../interfaces/post'

type Props = {  
  post: PostObject,
  fetchPost: Function
}

/*
const dataPost = {
    "id":1,
    "type":"link",
    "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
    "title":"Super title putaclic sa mère",
    "description":"Sa darrone ils boivent du sprite sa mère",
    "salt":18,
    "pepper":20,
    "date":"12 jan. 2017",
    "author":"Thomas Lerouô",
    "tags":["boisson","mere"]
}

const dataComments = [
  {
    "user":"Jean Yves",
    "userPic":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "date":"03 fév. 2017, 9h54",
    "message":"Ceci est une commentaire salé et non constructif",
    "salt":"27"
  },
  {
    "user":"Christopher Lassus",
    "userPic":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "date":"06 fév. 2017, 12h33",
    "message":" Being angry, agitated, upset. William Beckett(After his Sweater Shrinks): After all of that stressing about what we were going to wear and going shopping and scrambling. I'm a little salty.",
    "salt":"27",
    "answers": [
        {
            "user":"Jean Yves",
            "userPic":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
            "date":"03 fév. 2017, 9h54",
            "message":"Ceci est une commentaire salé et non constructif",
            "salt":"27"
        },
        {
            "user":"Jean Yves",
            "userPic":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
            "date":"03 fév. 2017, 9h54",
            "message":"Ceci est une commentaire salé et non constructif",
            "salt":"27"
        }
    ]
  }
]
*/


export const PostView = (props: Props) => {
    
    console.log(props)
    console.log(props.quentinptitcon)

    return(
        <div className="post"></div>
    )
}

PostView.propTypes = {  
  quentinptitcon: React.PropTypes.object,
  fetchPost: React.PropTypes.func.isRequired
}

export default PostView
