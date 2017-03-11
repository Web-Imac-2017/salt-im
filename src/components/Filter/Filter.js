import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Filter.scss'

export const Filter = () => (
    <div className="select">
        <span className="select__text">Filtrer par</span>
        <div className="select__wrap">
	        <select className="select__input">
	          <option className="select__input__active">taux de sel</option>
	          <option className="select__input__inactive">taux de poivre</option>
	          <option className="select__input__inactive">date</option>
	        </select>
        </div>
    </div>
)

export default Filter
