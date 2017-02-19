import React from 'react'
import { IndexLink, Link } from 'react-router'
import './PostPreview.scss'
import Tags from './Tags/Tags.js'
import PreviewLeft from './PreviewLeft/PreviewLeft.js'
import PreviewActions from './PreviewActions/PreviewActions.js'

export const PostPreview = (props) => {
    return(
        <div className="preview">
            <div className="preview__left">
                <PreviewLeft data={props.data}/>
            </div>
            <div className="preview__right">
                <div className="preview__title">{props.data.title}</div>
                <Tags data={props.data.tags}/>
                <div className="preview__description">{props.data.description}</div>
                <div className="preview__score">Salt : {props.data.salt}</div>
                <div className="preview__score">Pepper : {props.data.pepper}</div>

                <PreviewActions/>
            </div>
        </div>
    )

}

export default PostPreview

