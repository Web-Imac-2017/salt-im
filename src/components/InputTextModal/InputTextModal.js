import React from 'react'
import './InputTextModal.scss'

export const InputTextModal = (props) => (
    <div className="form__input">
        <label for={props.idInput}>{props.title}</label>
        <input type="text" name={props.title} id={props.idInput} value={props.placeholder}/>
    </div>
)

export default InputTextModal
