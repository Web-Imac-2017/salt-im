import React from 'react'
import { IndexLink, Link } from 'react-router'
import './PreviewActions.scss'

export const PreviewActions = () => (
    <div className="preview__actions">
        <div className="preview__action">Partager</div>
        <div className="preview__action">Sauvegarder</div>
        <div className="preview__action">Juger</div>
    </div>
)

export default PreviewActions

