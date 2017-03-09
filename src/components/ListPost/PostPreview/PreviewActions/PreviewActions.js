import React from 'react'
import { IndexLink, Link } from 'react-router'
import './PreviewActions.scss'

export const PreviewActions = (props) => (
    <div className="preview__actions">
        <div className="preview__action">
            <div className="preview__action__icon icon icon--comment"/>
            <div className="preview__action__value">
                {props.nbComment}
            </div>
        </div>
        <div className="preview__action">
            <div className="preview__action__icon icon icon--share"/>
        </div>
        <div className="preview__action">
            <div className="preview__action__icon icon icon--favorite"/>
        </div>
        <div className="preview__action preview__action--salty">
            <div className="preview__action__icon icon icon--salty"/>
            <div className="preview__action__value">66%</div>

            <div className="preview__action__reactions">
                <div className="preview__action__reactionwrapper">
                    <div className="preview__action__reaction">Wow</div>
                    <div className="preview__action__reaction">Grr</div>
                    <div className="preview__action__reaction">XPTDR</div>
                </div>
                <div className="preview__action__arrow"/>
            </div>
        </div>
    </div>
)

export default PreviewActions

