import React from 'react'
import { IndexLink, Link } from 'react-router'
import './PreviewLeft.scss'

export const PreviewLeft = (props) => {

    let picUrl = "https://yt3.ggpht.com/-r-NV4YMr0Gc/AAAAAAAAAAI/AAAAAAAAAAA/sCZE_m9wXoU/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"

    switch(props.data.type){
        case "image":
            picUrl = props.data.url;
            break;
        default:
            break;
    }

    let divStyle = {
            backgroundImage: 'url(' + picUrl + ')'
    }

    return(
        <div className="preview__background" style={divStyle}/>
    )

}

export default PreviewLeft

