import React from 'react'
import { IndexLink, Link } from 'react-router'
import './Filter.scss'

export const Filter = () => (
    <div className="select">
        <div className="select__text">Filtré par : </div>
        <select className="select__input">
          <option>Taux de sel</option>
          <option>Taux de poivre</option>
          <option>Date</option>
        </select>
    </div>
)

export default Filter
