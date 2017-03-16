import React from 'react'
import './InputTextarea.scss'

export const InputTextarea = (props) => (
    <div className="form__input form__input--textarea">
        <label for={props.idInput}>{props.title}</label>
        <textarea rows={10} name={props.title} id={props.idInput} value={props.placeholder}/>
    </div>
)

export default InputTextarea
