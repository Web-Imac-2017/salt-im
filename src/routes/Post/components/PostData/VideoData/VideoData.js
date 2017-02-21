import React from 'react'
import MainData from '../MainData/MainData.js'

function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}

export const VideoData = (props) => {
    let ytUrl = youtube_parser(props.data.url)
    console.log(ytUrl)

    return(
        <div className="videodata flex">
            <div className="videodata__left flex-4">
                <div className="iframeWrapper">
                    <iframe src={"https://www.youtube.com/embed/"+ytUrl+"?ecver=2"} width="480" height="360" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div className="videodata__right flex-6">
                <MainData data={props.data}/>
            </div>
        </div>
    )
}

export default VideoData
