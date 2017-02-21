import React from 'react'
import VideoData from './VideoData/VideoData.js'
import PicData from './PicData/PicData.js'
import TextData from './TextData/TextData.js'
import LinkData from './LinkData/LinkData.js'

export const PostData = () => {
    let type = "pic",
        nodeData;
    switch(type) {
        case "video":
            nodeData = (<VideoData/>);
            break;
        case "pic":
            nodeData =(<PicData/>)
            break;
        case "link":
            nodeData = (<LinkData/>);
            break;
        default:
            nodeData = (<TextData/>);
            break;
    }

    return(
      <div className="postdata">
        {nodeData}
      </div>
    )
}

export default PostData
