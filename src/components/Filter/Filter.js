import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Filter.scss'

export const Filter = () => (
    <div className="select">
        <span className="select__text">Filtrer par</span>
        <div className="select__wrap">
	        <select className="select__input">
	          <option>taux de sel</option>
	          <option>taux de poivre</option>
	          <option>taux d'humour</option>
	          <option>date</option>
	        </select>
        </div>
    </div>
)

export default Filter
