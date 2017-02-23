import React from 'react'
import './InputText.scss'

export const InputText = (props) => (
    <div className="form__input">
        <label for={props.idInput}>{props.title}</label>
        <input type="text" name={props.title} id={props.idInput} value={props.placeholder}/>
    </div>
)

export default InputText
