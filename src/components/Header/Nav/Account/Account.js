import React from 'react'
import { IndexLink, Link } from 'react-router'
import Pic from "./Pic/Pic.js"
import Pseudo from "./Pseudo/Pseudo.js"

export const Account = () => (
  <div className="user">
    <Pseudo/>
    <Pic/>
  </div>
)

export default Account

