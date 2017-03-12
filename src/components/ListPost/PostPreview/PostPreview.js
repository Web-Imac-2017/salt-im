import React from 'react'
import { IndexLink, Link } from 'react-router'
import './PostPreview.scss'
import Tags from './Tags/Tags.js'
import PreviewLeft from './PreviewLeft/PreviewLeft.js'
import PreviewActions from './PreviewActions/PreviewActions.js'
import Wave from './Wave/Wave.js'

export const PostPreview = (props) => {
    return(
        <div className="preview">
            <div className="preview__left">
                <PreviewLeft data={props.data}/>
            </div>
            <div className="preview__right">
                <div className="preview__content">
                    <div className="preview__title">{props.data.title}</div>
                    <Tags data={props.data.tags}/>
                    <div className="preview__description">{props.data.description}</div>
                    <PreviewActions data={props.data}/>
                    <div className="preview__infos">
                        <div className="preview__author">{props.data.author}</div>
                        <div className="preview__date">le {props.data.date}</div>
                    </div>
                </div>
                <Wave data={props.data}/>
            </div>
        </div>
    )

}

export default PostPreview

