import React from 'react'
import VideoData from './VideoData/VideoData.js'
import PicData from './PicData/PicData.js'
import TextData from './TextData/TextData.js'
import LinkData from './LinkData/LinkData.js'

export const PostData = (props) => {
    let nodeData;
    console.log(props.data);
    switch(props.data.type) {
        case "video":
            nodeData = (<VideoData data={props.data} nbComment={props.nbComment}/>);
            break;
        case "image":
            nodeData =(<PicData data={props.data} nbComment={props.nbComment}/>)
            break;
        case "link":
            nodeData = (<LinkData data={props.data} nbComment={props.nbComment}/>);
            break;
        default:
            nodeData = (<TextData data={props.data} nbComment={props.nbComment}/>);
            break;
    }

    let help = (<div/>);
    if(props.data.type == "u")
        help = (<div className="help">This man needs help</div>);

    return(
      <div className="postdata">
        <div className="postdata__top">
            <div className="content-wrapper">
                {nodeData}
                <div className="postdata__signal">signaler</div>
            </div>
        </div>
      </div>
    )
}

export default PostData
