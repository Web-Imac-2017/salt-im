import React from 'react'
import './InputTextareaModal.scss'

export const InputTextareaModal = (props) => (
    <div className="form__input form__input--textarea">
        <label for={props.idInput}>{props.title}</label>
        <textarea rows={10} name={props.title} id={props.idInput} value={props.placeholder}/>
    </div>
)

export default InputTextareaModal
