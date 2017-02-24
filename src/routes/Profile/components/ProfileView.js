import React from 'react'
import './ProfileView.scss'

const userData = [
  {
    "pseudo":"Jean-mi",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
   	"rank":"Salégaud",
   	"email":"jeanmi@mail.fr"
  }
]

console.log(userData)

export const ProfileView = () => (
  <div className="profile center">
    <h1 className="profile__qqc">{userData.pseudo}</h1>
  </div>
)

export default ProfileView
